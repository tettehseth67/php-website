<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";

// Restrict access to admins only
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "admin") {
    header("location: ../login.php");
    exit;
}

// Check if user ID is provided
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("location: manage_users.php");
    exit;
}

// Fetch user details
$user_id = $_GET["id"];
$sql = "SELECT username, role FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If user not found, redirect
if (!$user) {
    header("location: manage_users.php");
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_role = $_POST["role"];

    $update_sql = "UPDATE users SET role = :role WHERE id = :id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(":role", $new_role, PDO::PARAM_STR);
    $update_stmt->bindParam(":id", $user_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        header("location: manage_users.php?success=User role updated");
        exit;
    } else {
        echo "Error updating user role.";
    }
}
?>

<div class="container mt-4">
    <h2>Edit User</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="teacher" <?php if ($user['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        <a href="manage_users.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<?php require_once "includes/footer.php"; ?>