<?php
$title = 'Login';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];
        $new_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
        // Check if remember me is checked
        $rememberMe = isset($_POST['rememberMe']) ? true : false; // Check if remember me is checked
        // Create a new User object
        $user->getUsers($username, $password);
        // Check if the user exists in the database
        $result = $user->getUsers($username, $password);
        if($result) {
            // Set session variables
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            // Redirect to the home page
            header('Location: index.php');
            exit();
        }else {
            // If login fails, set an error message
            echo "Invalid username or password.";
            // Optionally, you can also log the failed attempt or take other actions
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Login</h1>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-label="User name" required value="<?php 
                        // Check if the form was submitted and populate the username field with the previous input if available
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
                            echo htmlspecialchars($_POST['username']);
                        }
                        ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
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

<?php require_once 'includes/footer.php'; ?>