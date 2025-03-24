<?php
session_start();
require_once 'db/db_conn.php'; // Database connection

// Collect form data
$email = $_POST['email'];
$password = $_POST['password'];

// Perform validation and check if the user exists
$query = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // If credentials are correct, set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    // Redirect to the appropriate dashboard or home page
    if ($user['role'] == 'admin') {
        header('Location: admin/dashboard.php?id='.$user['id']);
    } else {
        header('Location: index.php?id='.$user['id']);
    }
    exit();
} else {
    // If login fails, redirect to login with an error message
    $_SESSION['error'] = 'Invalid email or password';
    header('Location: login.php');
    exit();
}
