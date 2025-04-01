<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

// Ensure user is logged in as a teacher
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "teacher") {
    header("location: ../login.php");
    exit;
}

// Fetch students
$sql = "SELECT id, username FROM users WHERE role = 'student'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Students</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>View Attendance</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['username']); ?></td>
                    <td><a href="view_attendance.php?student_id=<?php echo $student['id']; ?>" class="btn btn-info">View Attendance</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>