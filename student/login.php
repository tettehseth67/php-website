<?php
// Start the session for handling errors
session_start();

// Include header and database connection
require_once 'includes/header.php';
// Initialize variables for form input and error handling
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If no errors, check credentials
    if (empty($username_err) && empty($password_err)) {
        require_once 'db/db_conn.php';

        // Prepare SQL to fetch user details
        $sql = "SELECT id, username, password, role FROM users WHERE username = :username";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Debug: Check the retrieved user data
                    echo "User found: " . $row["username"] . "<br>";

                    // Verify password if the username is correct
                    if (password_verify($password, $row["password"])) {
                        // Debug: Password verified successfully
                        echo "Password is correct.<br>";

                        // Regenerate session ID for security
                        session_regenerate_id(true);

                        // Store session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["role"] = $row["role"];

                        // Redirect based on role (e.g., admin, teacher, student)
                        require_once 'includes/session.php'; // session.php should handle the redirect
                    } else {
                        // Invalid password
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    // Invalid username
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt); // Close the statement
        }
        unset($conn); // Close the connection
    }
}
?>

<!-- HTML Form -->
<div class="container mt-5 mb-5 px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <?php if (!empty($login_err)): ?>
                <div class="alert alert-danger"><?php echo $login_err; ?></div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- Username Input -->
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>

                <!-- Password Input -->
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>

                <div>
                    <p class="mt-3">Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>