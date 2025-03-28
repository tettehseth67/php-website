<?php
$title = 'Home Page';

session_start();
require_once 'includes/header.php';
?>

<!-- Main Content -->
<div class="container px-5 py-5 d-flex align-items-center justify-content-center flex-column bg-body-tertiary">
    <h1>Welcome to our Attendance System</h1>
    <p>This is the home page of our attendance system.</p>

    <?php
    if (isset($_SESSION['user'])) {
        echo '<p>You are logged in as ' . $_SESSION['user']['name'] . '.</p>';
    } else {
        echo '<p>Please <a href="login.php">login</a> to access the system.</p>';
    }
    ?>
</div>





<?php
require 'includes/footer.php';
?>