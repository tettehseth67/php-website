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
    public function insertUsers($username, $password)
    {
        try {
            $result = $this->getUserByUsername($username);
            if ($result['num'] > 0) {
                return "Username already exists.";
            }else {
                $new_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $new_password);
                $stmt->execute();
                return "User created successfully.";
            }
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }

    public function getUsers($username, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        try {
            $sql = "SELECT count(*) as num FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }
}