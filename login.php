<?php
 // Ensure session starts at the beginning
$title = 'Login';
require_once 'includes/header.php';
require_once "db/db_conn.php";

// Initialize error variables
$login_err = $username_err = $password_err = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Proceed if no validation errors
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify password
            if (password_verify($password, $user["password"])) {
                // Regenerate session ID for security
                session_regenerate_id(true);

                // Store session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];

                // Debugging output (remove after testing)
                echo "<pre>SESSION DATA:\n";
                print_r($_SESSION);
                echo "</pre>";

                // Redirect based on role
                switch ($user["role"]) {
                    case "admin":
                        header("Location: /php-website/admin/dashboard.php");
                        break;
                    case "teacher":
                        header("Location: /php-website/teacher/dashboard.php");
                        break;
                    case "student":
                        header("Location: /php-website/student/dashboard.php");
                        break;
                    default:
                        echo "Unknown role detected. Please check your database.";
                        exit();
                }
                exit();
            } else {
                $login_err = "Invalid username or password!";
            }
        } else {
            $login_err = "Invalid username or password!";
        }
    }
}
?>

<div class="container mt-5 mb-5 px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
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