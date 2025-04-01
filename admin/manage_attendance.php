<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

// Check if the user is an admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "admin") {
    header("location: ../login.php");
    exit;
}

// Fetch attendance records
$sql = "SELECT a.id, s.username AS student_name, a.date, a.status 
        FROM attendance a 
        JOIN users s ON a.student_id = s.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$attendance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Manage Attendance</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendance_records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['id']); ?></td>
                    <td><?php echo htmlspecialchars($record['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($record['date']); ?></td>
                    <td><?php echo htmlspecialchars($record['status']); ?></td>
                    <td>
                        <a href="edit_attendance.php?id=<?php echo $record['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>