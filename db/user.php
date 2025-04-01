<?php

class User
{
    private $db;

    // Constructor to initialize private variable to the database connection
    public function __construct($conn)
    {
        $this->db = $conn;
    }

    // Function to insert a new user into the database
    public function insertUsers($username, $password, $role = 'student')
    {
        try {
            if ($this->userExists($username)) {
                return "Username already exists.";
            }

            $new_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $new_password);
            $stmt->bindParam(':role', $role);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // Function to fetch user and verify password
    public function getUsers($username, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify password if user exists
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return false; // Authentication failed
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Check if user exists
    public function userExists($username)
    {
        try {
            $sql = "SELECT COUNT(*) as num FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['num'] > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
