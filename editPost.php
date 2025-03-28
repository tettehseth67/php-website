<?php
require_once 'db/db_conn.php';
//Get values from post method
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialty = $_POST['specialty'];

    //Call the update method from Crud class
    $isUpdated = $crud->editAttendee($id, $fname, $lname, $dob, $email, $phone, $specialty);
    if ($isUpdated) {
        header("Location: attendees.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">Error while updating record!</div>';
    }
}else {
    echo '<div class="alert alert-danger" role="alert">No record found!</div>';
    exit();
}


