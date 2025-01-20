<?php

class user {
    private $db;

    function __construct($conn) {
        $this->db = $conn;
    }

    public function insertUser($username, $password) {
        try {
            // Check if the username already exists
            $result = $this->getUserByUsername($username);
            if ($result['num'] > 0) {
                // Return error if username already exists
                return [
                    'success' => false,
                    'error' => 'Username already exists!'
                ];
            }

            // Add new user if username is unique
            $new_password = md5($password . $username);
            $sql = "INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $new_password);
            $stmt->execute();

            // Return success message
            return [
                'success' => true,
                'message' => 'User added successfully!'
            ];
        } catch (PDOException $e) {
            // Return error if any exception occurs
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function insertUserWithSystemPassword($username, $password, $system_password) {
        try {
            // Check if the system's username exists in the database
            $systemUsername = 'zeal2025';
            $systemPasswordQuery = "SELECT `password` FROM `users` WHERE `username` = :systemUsername";
            $stmt = $this->db->prepare($systemPasswordQuery);
            $stmt->bindparam(':systemUsername', $systemUsername);
            $stmt->execute();

            $systemResult = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify system password
            if (!$systemResult || md5($system_password . $systemUsername) !== $systemResult['password']) {
                // System password is incorrect or the system username doesn't exist
                return [
                    'success' => false,
                    'error' => 'Invalid system password!'
                ];
            }

            // Check for duplicate username
            $result = $this->getUserByUsername($username);
            if ($result['num'] > 0) {
                return [
                    'success' => false,
                    'error' => 'Username already exists!'
                ];
            }

            // Add new user if system password is verified and username is unique
            $new_password = md5($password . $username);
            $sql = "INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $new_password);
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'User added successfully!'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getUser($username, $password) {
        try {
            $sql = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";

            $stmt = $this->db->prepare($sql);

            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $password);

            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($username) {
        try {
            $sql = "SELECT count(*) AS num FROM `users` WHERE `username` = :username";

            $stmt = $this->db->prepare($sql);

            $stmt->bindparam(':username', $username);

            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>