<?php
$title = 'Registration';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

$results = $crud->getSpecialties();

?>

<div class="container px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">User Registration</h1>

            <form action="registered.php" method="post">
                <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-label="User name" required>
                    </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" required>
                    <small id="passwordHelp" class="form-text text-muted text-light">
                        Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.
                    </small>
                </div>
                <div class="mb-3">
                    <label for="pswd-repeat" class="form-label">Repeat Password</label>
                    <input type="password" class="form-control" id="pswd-repeat" name="pswd-repeat" aria-describedby="pswdRepeatHelp" required>
                    <small id="pswdRepeatHelp" class="form-text text-muted text-light">
                        Please repeat your password.
                    </small>
                </div>
                <div class="mb-3">
                    <p>
                        You already have an account? <a href="login.php">Login</a>
                    </p>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>