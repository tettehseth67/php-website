<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

// Ensure user is logged in as a student
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "student") {
    header("location: ../login.php");
    exit;
}

// Get the student's attendance records
$sql = "SELECT date, status FROM attendance WHERE student_id = :student_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":student_id", $_SESSION["id"], PDO::PARAM_INT);
$stmt->execute();
$attendance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Your Attendance Records</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendance_records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['date']); ?></td>
                    <td><?php echo htmlspecialchars($record['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>