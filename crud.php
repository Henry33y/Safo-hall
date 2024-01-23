<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }
        public function insert($firstName,$lastName,$studentId,$category,$level,$programme,$contact,$email,$parentName,$parentContact,$disability,$scholarshipSpecify,$roomNumber){
            try {
                $sql = "INSERT INTO `student_registration_info`(`first_name`, `last_name`, `student_id`, `category`, `programme`, `level`, `email`, `contact`, `parent_name`, `parent_contact`, `physical_challenges`, `scholarship`, `room_number`)
                VALUES (:firstName:,:lastName,:studentId,:category,:programme,:level,:email,:contact,:parentName,:parentContact,:disability,:scholarshipSpecify,:roomNumber)";

                $stmt = $this->db->prepare($sql);

                $stmt->bindparam(':firstName',$firstName);
                $stmt->bindparam(':lastName',$lastName);
                $stmt->bindparam(':studentId',$studentId);
                $stmt->bindparam(':category',$category);
                $stmt->bindparam(':programme',$programme);
                $stmt->bindparam(':level',$level);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':parentName',$parentName);
                $stmt->bindparam(':parentContact',$parentContact);
                $stmt->bindparam(':disability',$disability);
                $stmt->bindparam(':scholarship',$scholarshipSpecify);

                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>