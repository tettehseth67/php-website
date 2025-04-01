<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

// Ensure user is logged in as an admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "admin") {
    header("location: ../login.php");
    exit;
}

// Fetch all teachers
$sql = "SELECT id, username FROM users WHERE role = 'teacher'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Manage Teachers</h2>
    <a href="add_teacher.php" class="btn btn-success mb-3">Add Teacher</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?php echo htmlspecialchars($teacher['username']); ?></td>
                    <td>
                        <a href="edit_teacher.php?id=<?php echo $teacher['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="delete_teacher.php?id=<?php echo $teacher['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>