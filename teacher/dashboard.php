<?php
// Start session and check if the user is logged in and has the correct role
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== 'teacher') {
    header("Location: ../login.php");
    exit();
}

echo "Welcome, Teacher!";
?>
<!-- Your Teacher Dashboard Content here -->