<?php

require_once 'db/db_conn.php';

if(!isset($_GET['id'])) {
    echo '<div class="alert alert-danger" role="alert">No record found!</div>';
    exit();
} else {
    $id = $_GET['id'];
    // Call the delete function from Crud class
    $isDeleted = $crud->deleteAttendee($id);
    if($isDeleted) {
        header("Location: attendees.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">Unable to delete record!</div>';
    }
}