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

// Get student schedules
$sql = "SELECT subject, time, location FROM schedules WHERE student_id = :student_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":student_id", $_SESSION["id"], PDO::PARAM_INT);
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Your Class Schedule</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Time</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?php echo htmlspecialchars($schedule['subject']); ?></td>
                    <td><?php echo htmlspecialchars($schedule['time']); ?></td>
                    <td><?php echo htmlspecialchars($schedule['location']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>