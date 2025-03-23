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

    public function getAttendeesById($id)
    {
        $sql = "SELECT * FROM attendees a inner join specialties s on a.specialty_id = s.specialty_id WHERE attendee_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editAttendees($id, $fname, $lname, $dob, $email, $phone, $specialty)
    {
        try {
            $sql = "UPDATE attendees SET fname = :fname, lname = :lname, dob = :dob, email = :email, phone = :phone, specialty_id = :specialty WHERE attendee_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
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

    public function deleteAttendees($id)
    {
        try {
            $sql = "DELETE FROM attendees WHERE attendee_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }

    public function getUserByEmail($email) {
        // Assuming $this->db is the database connection
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}