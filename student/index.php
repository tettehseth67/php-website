<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header("Location: https://yourdomain.com");
    exit();
}
echo "<h1>Welcome Student!</h1>";
