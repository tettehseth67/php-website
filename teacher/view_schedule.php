<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";

// Ensure user is logged in as a teacher
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "teacher") {
    header("location: ../login.php");
    exit;
}

// Get the teacher's schedule
$sql = "SELECT course_name FROM schedules WHERE teacher_id = :teacher_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":teacher_id", $_SESSION["id"], PDO::PARAM_INT);
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Your Teaching Schedule</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?php echo htmlspecialchars($schedule['course_name']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/footer.php"; ?>