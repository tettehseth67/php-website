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

if (!$conn) {
    die("Database connection failed.");
}

// Fetch all students
$sql = "SELECT id, username FROM users WHERE role = 'student'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Manage Students</h2>
    <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['username']); ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>