<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }
        public function insertStudentInfo($firstName,$lastName,$studentId,$category,$level,$programme,$contact,$email,$parentName,$parentContact,$disability,$scholarshipSpecify,$roomNumber){
            try {
                $result = $this->getStudentByStudentId($studentId);
                if($result['num'] > 0){
                    echo '<div class="alert alert-danger" role="alert">User has already registered. Please check details and retry.</div>';
                    return false;
                }
                else{
                    // Check if room is not at maximum capacity
                    $roomDetails = $this->getRoomDetailsByRoomNumber($roomNumber);
                    if ($roomDetails['current_students'] < $roomDetails['max_students']) {
                        // Increment current students count
                        $roomDetails['current_students']++;

                        // Update current students count in the database
                        $this->updateRoomCurrentStudents($roomNumber, $roomDetails['current_students']);

                        $sql = "INSERT INTO `student_registration_info`(`first_name`, `last_name`, `student_id`, `category`, `programme`, `level`, `email`, `contact`, `parent_name`, `parent_contact`, `physical_challenges`, `scholarship`, `room_number`)
                        VALUES (:firstName,:lastName,:studentId,:category,:programme,:level1,:email,:contact,:parentName,:parentContact,:disability,:scholarshipSpecify,:roomNumber)";
        
                        $stmt = $this->db->prepare($sql);
        
                        $stmt->bindparam(':firstName',$firstName);
                        $stmt->bindparam(':lastName',$lastName);
                        $stmt->bindparam(':studentId',$studentId);
                        $stmt->bindparam(':category',$category);
                        $stmt->bindparam(':programme',$programme);
                        $stmt->bindparam(':level1',$level);
                        $stmt->bindparam(':email',$email);
                        $stmt->bindparam(':contact',$contact);
                        $stmt->bindparam(':parentName',$parentName);
                        $stmt->bindparam(':parentContact',$parentContact);
                        $stmt->bindparam(':disability',$disability);
                        $stmt->bindparam(':scholarshipSpecify',$scholarshipSpecify);
                        $stmt->bindparam(':roomNumber',$roomNumber);
        
                        $stmt->execute();
                        return true;
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function editStudentDetails($id,$firstName,$lastName,$studentId,$category,$level,$programme,$contact,$email,$parentName,$parentContact,$disability,$scholarshipSpecify,$oldRoomNumber,$newRoomNumber){
            try{
                $oldRoomDetails = $this->getRoomDetailsByRoomNumber($oldRoomNumber);
                $newRoomDetails = $this->getRoomDetailsByRoomNumber($newRoomNumber);

                if ($oldRoomNumber !== $newRoomNumber) {
                    if ($newRoomDetails['current_students'] < $newRoomDetails['max_students']) {
                        $newRoomDetails['current_students']++;
                        $this->updateRoomCurrentStudents($newRoomNumber, $newRoomDetails['current_students']);

                        $oldRoomDetails['current_students']--;
                        $this->updateRoomCurrentStudents($oldRoomNumber, $oldRoomDetails['current_students']);
                    } else {
                        echo 'New room is at maximum capacity';
                        return false;
                    }
            }

                $sql = "UPDATE `student_registration_info` SET `first_name`=:firstName,`last_name`=:lastName,`student_id`=:studentId,`category`=:category,`programme`=:programme,`level`=:level1,`email`=:email,`contact`=:contact,`parent_name`=:parentName,`parent_contact`=:parentContact,`physical_challenges`=:disability,`scholarship`=:scholarshipSpecify,`room_number`=:roomNumber WHERE id= :id";

                $stmt = $this->db->prepare($sql);
                
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':firstName',$firstName);
                $stmt->bindparam(':lastName',$lastName);
                $stmt->bindparam(':studentId',$studentId);
                $stmt->bindparam(':category',$category);
                $stmt->bindparam(':programme',$programme);
                $stmt->bindparam(':level1',$level);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':parentName',$parentName);
                $stmt->bindparam(':parentContact',$parentContact);
                $stmt->bindparam(':disability',$disability);
                $stmt->bindparam(':scholarshipSpecify',$scholarshipSpecify);
                $stmt->bindparam(':roomNumber',$newRoomNumber);
                
                $stmt->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        public function getStudentInfo(){
            try{
                $sql = 'SELECT * FROM student_registration_info';
                $result = $this->db->query($sql);
                return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getRoomDetails(){
            try{
                $sql = 'SELECT * FROM rooms';
                $result = $this->db->query($sql);
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getSingleStudentDetails($id){
            try{
                $sql = 'SELECT * FROM student_registration_info WHERE id = :id';
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getStudentByStudentId($studentId){
            try{
                $sql = 'SELECT count(*) AS num FROM student_registration_info WHERE student_id = :studentId';
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':studentId',$studentId);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function deleteStudentRecord($id){
            try{
                $result = $this->getSingleStudentDetails($id);
                $roomNumber = $result['room_number'];
                $roomDetails = $this->getRoomDetailsByRoomNumber($roomNumber);
                $this->updateRoomCurrentStudents($roomNumber,$roomDetails['current_students']-1);

                $sql = "DELETE FROM student_registration_info WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
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
                echo $e->getMessage();
            }
        }

        public function updateRoomCurrentStudents($roomNumber, $currentStudents){
            try {
                $sql = 'UPDATE rooms SET current_students = :currentStudents WHERE room_number = :roomNumber';
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':roomNumber', $roomNumber);
                $stmt->bindparam(':currentStudents', $currentStudents);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function updateRoomDetails($roomNumber, $currentStudents, $maxStudents){
            try {
                $sql = 'UPDATE rooms SET current_students = :currentStudents, max_students = :maxStudents WHERE room_number = :roomNumber';
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':roomNumber', $roomNumber);
                $stmt->bindparam(':currentStudents', $currentStudents);
                $stmt->bindparam(':maxStudents', $maxStudents);
                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>