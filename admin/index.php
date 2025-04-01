<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: https://yourdomain.com");
    exit();
}
echo "<h1>Welcome Admin!</h1>";
