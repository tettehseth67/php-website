<?php

class Student {
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertStudents()
    {
        $sql = "INSERT INTO students (fname, lname, dateofbirth, emailaddress,) VALUES ()";
    }

    public function getStudents()
    {
        $sql = "SELECT * FROM students";
        $student = $this->db->query($sql);
        return $student->fetchAll();
    }
}