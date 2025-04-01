<?php
// title: register.php
$title = 'Register';

// Include config file
require_once "includes/header.php";
require_once "db/db_conn.php";
require_once "db/user.php";

// Initialize the User object
$user = new User($conn);

// Define variables and initialize with empty values
$username = $password = $confirm_password = $role = "";
$username_err = $password_err = $confirm_password_err = $register_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Check if username already exists
        $sql = "SELECT id FROM users WHERE username = :username";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }

            unset($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must be at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Capture the role selected by the user
    if (empty($_POST["role"])) {
        $register_err = "Please select a role.";
    } else {
        $role = $_POST["role"];  // This stores the selected role
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($register_err)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database with the selected role
        $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":role", $param_role, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = $hashed_password;
            $param_role = $role;  // Bind the role here

            if ($stmt->execute()) {
                echo "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            unset($stmt);
        }
    }

    // Close connection
    unset($conn);
}
?>

<div class="container mt-5 mb-5 px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Register</h2>
            <p>Please fill in this form to create an account.</p>

            <?php
            if (!empty($register_err)) {
                echo '<div class="alert alert-danger">' . $register_err . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="role">Select Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Register">
                </div>
                <div>
                    <p class="mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>