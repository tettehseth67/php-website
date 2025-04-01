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

// Fetch all schedules
$sql = "SELECT schedules.id, schedules.subject, schedules.time, users.username AS teacher FROM schedules
        JOIN users ON schedules.teacher_id = users.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Manage Schedules</h2>
    <a href="add_schedule.php" class="btn btn-success mb-3">Add Schedule</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Time</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?php echo htmlspecialchars($schedule['subject']); ?></td>
                    <td><?php echo htmlspecialchars($schedule['time']); ?></td>
                    <td><?php echo htmlspecialchars($schedule['teacher']); ?></td>
                    <td>
                        <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>