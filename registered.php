<?php
session_start();
require_once 'db/db_conn.php';

// Collect form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Assuming you've already initialized $conn (the PDO connection)
$query = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);

// Bind the parameters to the placeholders
$stmt->bindParam(1, $fname);
$stmt->bindParam(2, $lname);
$stmt->bindParam(3, $email);
$stmt->bindParam(4, $password);

// Execute the statement
$stmt->execute();

// Check if the insert was successful
if ($stmt->rowCount() > 0) {
    echo "Registration successful!";
} else {
    echo "There was an error with the registration.";
}

// Check if insertion was successful
if ($stmt->rowCount() > 0) {
    $_SESSION['message'] = 'Registration successful!';
    header('Location: login.php');
} else {
    $_SESSION['error'] = 'Registration failed. Please try again.';
    header('Location: register.php');
}
exit();

