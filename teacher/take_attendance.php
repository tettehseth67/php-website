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

// Fetch students for attendance marking
$sql = "SELECT id, username FROM users WHERE role = 'student'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process attendance submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['attendance'] as $student_id => $status) {
        $sql = "INSERT INTO attendance (student_id, teacher_id, date, status) VALUES (:student_id, :teacher_id, NOW(), :status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student_id,
            ':teacher_id' => $_SESSION['id'],
            ':status' => $status
        ]);
    }
    echo "<div class='alert alert-success'>Attendance recorded successfully!</div>";
}
?>

<div class="container mt-4">
    <h2>Take Attendance</h2>
    <form method="post">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['username']); ?></td>
                        <td><input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="Present" required></td>
                        <td><input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="Absent"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
</div>

<?php require_once "includes/footer.php"; ?>