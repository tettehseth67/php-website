<?php

require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Check if the form has been submitted
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user exists in the database
        $user = $crud->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to home page
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Invalid email or password.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

require_once 'includes/footer.php';
?>