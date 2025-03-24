<?php
session_start();  // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php'); // Redirect if not logged in
    exit();
}

// Include your database connection file
// require_once 'db/connection.php'; // Uncomment if needed

// Retrieve user data from the database
$user = $crud->getUserById($_SESSION['user_id']);

// Check if the user is an admin and handle redirection
if ($user['role'] != 'admin' && isset($_GET['page']) && $_GET['page'] == 'admin_dashboard') {
    header('Location: main.php?page=students'); // Redirect to students page if not admin
    exit();
}

// Function to load the page dynamically
function loadPage($page) {
    global $conn; // Access the connection

    // Define the allowed pages and their corresponding file paths
    $allowed_pages = [
        'student_create' => 'pages/students/student_create.php',
        'students' => 'pages/students/students.php',
        'student_success' => 'pages/students/student_success.php',
        'admin_dashboard' => 'admin/dashboard.php',
        'login' => 'auth/login.php',
        'register' => 'auth/register.php'
    ];

    // If the page exists in the allowed pages, include it
    if (array_key_exists($page, $allowed_pages)) {
        include($allowed_pages[$page]);
    } else {
        // Default page if the requested page doesn't exist
        include 'pages/students/students.php';
    }
}

// Default page is 'students' if no 'page' is provided in the URL
$page = isset($_GET['page']) ? $_GET['page'] : 'students';

// Load the requested page
loadPage($page);


