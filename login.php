<?php
$title = 'Login';
require_once 'includes/header.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Login</h1>

            <form action="submit_registration.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <p class="text-start mt-3">Don't have an account? <a href="register.php">Register here</a></p>

                <p class="text-start mt-3">Forgot Password? <a href="forgot_password.php">Reset Password</a></p>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>