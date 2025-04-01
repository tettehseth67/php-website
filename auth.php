<?php
session_start();

function checkRole($role)
{
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== $role) {
        header("location: login.php");
        exit();
    }
}
