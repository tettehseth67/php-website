<?php

class Crud {

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insert($fname, $lname, $dob, $email, $phone, $specialty)
    {
        try {
            $sql = "INSERT INTO attendees(fname, lname, dob, email, phone, specialty_id) VALUES (:fname, :lname, :dob, :email, :phone, :specialty)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':specialty', $specialty);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }
    public function read()
    {
        $sql = "SELECT * FROM attendees";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}