<?php

class Crud {

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertAttendees($fname, $lname, $dob, $email, $phone, $specialty)
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

    public function getAttendees()
    {
        $sql = "SELECT * FROM attendees a inner join specialties s on a.specialty_id = s.specialty_id";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

    public function getSpecialties()
    {
        $sql = "SELECT * FROM specialties";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }
}