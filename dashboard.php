<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

require_once "db/db_conn.php";
require_once "db/user.php";

echo "<h1>Welcome, " . htmlspecialchars($_SESSION["username"]) . "!</h1>";
?>

<a href="logout.php">Logout</a>