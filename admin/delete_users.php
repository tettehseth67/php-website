<?php
session_start();
require_once "../db/db_conn.php";

// Restrict access to admins only
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "admin") {
    header("location: ../login.php");
    exit;
}

// Check if user ID is provided
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $user_id = $_GET["id"];

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("location: manage_users.php?success=User deleted");
        exit;
    } else {
        echo "Error deleting user.";
    }
} else {
    header("location: manage_users.php");
    exit;
}
