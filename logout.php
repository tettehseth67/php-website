<?php

session_start(); // Start the session

// Unset all session variables to log out the user
$_SESSION = array(); // Clear the session array

// Destroy the session

if (session_destroy()) {
    // Redirect to the login page after logout
    header('Location: login.php');
}