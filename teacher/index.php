<?php
session_start();
if ($_SESSION['role'] !== 'teacher') {
    header("Location: https://yourdomain.com");
    exit();
}
echo "<h1>Welcome Teacher!</h1>";
