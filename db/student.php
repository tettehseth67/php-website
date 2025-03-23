<?php

class Student {
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertStudents($fname, $lname, $dateofbirth, $emailaddress, $phonenumber, $course)
    {
        try {
            $sql = "INSERT INTO students(fname, lname, dateofbirth, emailaddress, phonenumber, course) VALUES (:fname, :lname, :dateofbirth, :emailaddress, :phonenumber, :course)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':dateofbirth', $dateofbirth);
            $stmt->bindParam(':emailaddress', $emailaddress);
            $stmt->bindParam(':phonenumber', $phonenumber);
            $stmt->bindParam(':course', $course);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }

    public function getStudents()
    {
        $sql = "SELECT * FROM students";
        $student = $this->db->query($sql);
        return $student->fetchAll();
    }

    public function getCourse()
    {
        $sql = "SELECT * FROM courses";
        $course = $this->db->query($sql);
        return $course->fetchAll();
    }
}