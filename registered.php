<?php
session_start();
require_once 'db/db_conn.php';

// Collect form data
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password for security
$new_password = password_hash($password, PASSWORD_BCRYPT);

// Assuming you've already initialized $conn (the PDO connection)
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);

// Bind the parameters to the placeholders
$stmt->bindParam(1, $username);
$stmt->bindParam(2, $new_password);

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

