<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=php_website_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<div class='alert alert-success'>Connected successfully</div>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require_once 'crud.php';
require_once 'user.php';
require_once 'student.php';

//define new instance of crud class
$crud = new Crud($conn);
$user = new User($conn);
$student = new Student($conn);

$user->insertUsers("admin", "password");
