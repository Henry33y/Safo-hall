<?php
class crud
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertStudentInfo($firstName, $lastName, $studentId, $category, $level, $programme, $contact, $email, $parentName, $parentContact, $disability, $scholarshipSpecify, $area, $roomNumber)
    {
        try {
            $result = $this->getStudentByStudentId($studentId);
            if ($result['num'] > 0) {
                return [
                    'success' => false,
                    'error' => 'User has already registered. Please check details and retry.'
                ];
            } else {
                // Check if room is not at maximum capacity
                $roomDetails = $this->getRoomDetailsByRoomNumber($roomNumber);
                if ($roomDetails['current_students'] < $roomDetails['max_students']) {
                    // Increment current students count
                    $roomDetails['current_students']++;

                    // Update current students count in the database
                    $this->updateRoomCurrentStudents($roomNumber, $roomDetails['current_students']);

                    $sql = "INSERT INTO `student_registration_info`(`first_name`, `last_name`, `student_id`, `category`, `programme`, `level`, `email`, `contact`, `parent_name`, `parent_contact`, `physical_challenges`, `scholarship`, `area`, `room_number`) VALUES (:firstName,:lastName,:studentId,:category,:programme,:level1,:email,:contact,:parentName,:parentContact,:disability,:scholarshipSpecify,:area,:roomNumber)";

                    $stmt = $this->db->prepare($sql);

                    $stmt->bindparam(':firstName', $firstName);
                    $stmt->bindparam(':lastName', $lastName);
                    $stmt->bindparam(':studentId', $studentId);
                    $stmt->bindparam(':category', $category);
                    $stmt->bindparam(':programme', $programme);
                    $stmt->bindparam(':level1', $level);
                    $stmt->bindparam(':email', $email);
                    $stmt->bindparam(':contact', $contact);
                    $stmt->bindparam(':parentName', $parentName);
                    $stmt->bindparam(':parentContact', $parentContact);
                    $stmt->bindparam(':disability', $disability);
                    $stmt->bindparam(':scholarshipSpecify', $scholarshipSpecify);
                    $stmt->bindparam(':area', $area);
                    $stmt->bindparam(':roomNumber', $roomNumber);

                    $stmt->execute();
                    return [
                        'success' => true,
                        'message' => 'Student registration successful!'
                    ];
                } else {
                    return [
                        'success' => false,
                        'error' => 'Room is at full capacity.'
                    ];
                }
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function editStudentDetails($id, $firstName, $lastName, $studentId, $category, $level, $programme, $contact, $email, $parentName, $parentContact, $disability, $scholarshipSpecify, $area, $oldRoomNumber, $newRoomNumber)
    {
        try {
            $oldRoomDetails = $this->getRoomDetailsByRoomNumber($oldRoomNumber);
            $newRoomDetails = $this->getRoomDetailsByRoomNumber($newRoomNumber);

            if ($oldRoomNumber !== $newRoomNumber) {
                if ($newRoomDetails['current_students'] < $newRoomDetails['max_students']) {
                    $newRoomDetails['current_students']++;
                    $this->updateRoomCurrentStudents($newRoomNumber, $newRoomDetails['current_students']);

                    $oldRoomDetails['current_students']--;
                    $this->updateRoomCurrentStudents($oldRoomNumber, $oldRoomDetails['current_students']);
                } else {
                    return [
                        'success' => false,
                        'error' => 'New room is at maximum capacity.'
                    ];
                }
            }

            $sql = "UPDATE `student_registration_info` SET `first_name`=:firstName,`last_name`=:lastName,`student_id`=:studentId,`category`=:category,`programme`=:programme,`level`=:level1,`email`=:email,`contact`=:contact,`parent_name`=:parentName,`parent_contact`=:parentContact,`physical_challenges`=:disability,`scholarship`=:scholarshipSpecify,`area`=:area,`room_number`=:roomNumber WHERE id= :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindparam(':id', $id);
            $stmt->bindparam(':firstName', $firstName);
            $stmt->bindparam(':lastName', $lastName);
            $stmt->bindparam(':studentId', $studentId);
            $stmt->bindparam(':category', $category);
            $stmt->bindparam(':programme', $programme);
            $stmt->bindparam(':level1', $level);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':contact', $contact);
            $stmt->bindparam(':parentName', $parentName);
            $stmt->bindparam(':parentContact', $parentContact);
            $stmt->bindparam(':disability', $disability);
            $stmt->bindparam(':scholarshipSpecify', $scholarshipSpecify);
            $stmt->bindparam(':area', $area);
            $stmt->bindparam(':roomNumber', $newRoomNumber);

            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Student details updated successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getStudentInfo()
    {
        try {
            $sql = 'SELECT * FROM student_registration_info';
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getRoomDetails()
    {
        try {
            $sql = 'SELECT * FROM rooms';
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getSingleStudentDetails($id)
    {
        try {
            $sql = 'SELECT * FROM student_registration_info WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getStudentByStudentId($studentId)
    {
        try {
            $sql = 'SELECT count(*) AS num FROM student_registration_info WHERE student_id = :studentId';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':studentId', $studentId);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function deleteStudentRecord($id)
    {
        try {
            $result = $this->getSingleStudentDetails($id);
            $roomNumber = $result['room_number'];
            $roomDetails = $this->getRoomDetailsByRoomNumber($roomNumber);
            $this->updateRoomCurrentStudents($roomNumber, $roomDetails['current_students'] - 1);

            $sql = "DELETE FROM student_registration_info WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Student record deleted successfully.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getRoomDetailsByRoomNumber($roomNumber)
    {
        try {
            $sql = 'SELECT * FROM rooms WHERE room_number = :roomNumber';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':roomNumber', $roomNumber);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateRoomCurrentStudents($roomNumber, $currentStudents)
    {
        try {
            $sql = 'UPDATE rooms SET current_students = :currentStudents WHERE room_number = :roomNumber';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':roomNumber', $roomNumber);
            $stmt->bindparam(':currentStudents', $currentStudents);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateRoomDetails($roomNumber, $currentStudents, $maxStudents)
    {
        try {
            $sql = 'UPDATE rooms SET current_students = :currentStudents, max_students = :maxStudents WHERE room_number = :roomNumber';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':roomNumber', $roomNumber);
            $stmt->bindparam(':currentStudents', $currentStudents);
            $stmt->bindparam(':maxStudents', $maxStudents);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    public function lockRoomStatus($roomNumber)
    {
        $sql = "UPDATE rooms SET status = 'locked' WHERE room_number = :roomNumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':roomNumber', $roomNumber);
        return $stmt->execute();
    }
    public function unlockRoomStatus($roomNumber)
    {
        $sql = "UPDATE rooms SET status = 'open' WHERE room_number = :roomNumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':roomNumber', $roomNumber);
        return $stmt->execute();
    }
    // Insert a pending registration (reserves the room and inserts with status='pending' and payment_reference)
    public function insertPendingStudentInfo($firstName, $lastName, $studentId, $category, $level, $programme, $contact, $email, $parentName, $parentContact, $disability, $scholarshipSpecify, $area, $roomNumber, $paymentReference)
    {
        try {
            // Prevent duplicate registration
            $result = $this->getStudentByStudentId($studentId);
            if ($result['num'] > 0) {
                return [
                    'success' => false,
                    'error' => 'User has already registered. Please check details and retry.'
                ];
            }

            // Check room capacity and reserve a slot
            $roomDetails = $this->getRoomDetailsByRoomNumber($roomNumber);
            if ($roomDetails['current_students'] < $roomDetails['max_students']) {
                $roomDetails['current_students']++;
                $this->updateRoomCurrentStudents($roomNumber, $roomDetails['current_students']);

                $sql = "INSERT INTO `student_registration_info`
              (`first_name`,`last_name`,`student_id`,`category`,`programme`,`level`,`email`,`contact`,`parent_name`,`parent_contact`,`physical_challenges`,`scholarship`,`area`,`room_number`,`status`,`payment_reference`)
              VALUES (:firstName,:lastName,:studentId,:category,:programme,:level1,:email,:contact,:parentName,:parentContact,:disability,:scholarshipSpecify,:area,:roomNumber,'pending',:paymentReference)";

                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':firstName', $firstName);
                $stmt->bindparam(':lastName', $lastName);
                $stmt->bindparam(':studentId', $studentId);
                $stmt->bindparam(':category', $category);
                $stmt->bindparam(':programme', $programme);
                $stmt->bindparam(':level1', $level);
                $stmt->bindparam(':email', $email);
                $stmt->bindparam(':contact', $contact);
                $stmt->bindparam(':parentName', $parentName);
                $stmt->bindparam(':parentContact', $parentContact);
                $stmt->bindparam(':disability', $disability);
                $stmt->bindparam(':scholarshipSpecify', $scholarshipSpecify);
                $stmt->bindparam(':area', $area);
                $stmt->bindparam(':roomNumber', $roomNumber);
                $stmt->bindparam(':paymentReference', $paymentReference);

                $stmt->execute();
                return [
                    'success' => true,
                    'message' => 'Pending registration saved.'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Room is at full capacity.'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    // Get student row by payment reference
    public function getStudentByReference($paymentReference)
    {
        try {
            $sql = 'SELECT * FROM student_registration_info WHERE payment_reference = :ref LIMIT 1';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':ref', $paymentReference);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Mark pending student as paid
    public function markStudentPaid($paymentReference)
    {
        try {
            $sql = "UPDATE student_registration_info SET status = 'paid' WHERE payment_reference = :ref";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':ref', $paymentReference);
            $stmt->execute();
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
