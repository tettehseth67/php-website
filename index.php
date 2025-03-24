<?php
$title = 'Home Page';

session_start();
require_once 'includes/header.php';
?>

<!-- Main Content -->
<div class="container px-5 py-4 d-flex align-items-center justify-content-center flex-column">
    <h1>Welcome to our Attendance System</h1>
    <p>This is the home page of our attendance system.</p>
</div>


<?php
require 'includes/footer.php';
?>