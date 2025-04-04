<?php
session_start();
require_once "../db/db_conn.php";
require_once "includes/header.php";

// Ensure user is logged in as an admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "admin") {
    header("location: ../login.php");
    exit;
}

// Fetch all schedules
$sql = "SELECT schedules.id, schedules.course_name, schedules.teacher_id, schedules.student_id, schedules.day, schedules.start_time, schedules.end_time, schedules.room_number, users.username AS teacher FROM schedules
        JOIN users ON schedules.teacher_id = users.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">
                            <span data-feather="check-square"></span>
                            Manage Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_teachers.php">
                            <span data-feather="calendar"></span>
                            Manage Teachers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_students.php">
                            <span data-feather="book"></span>
                            Manage Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_schedules.php">
                            <span data-feather="book-open"></span>
                            Manage Schedules
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Schedules</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

            <div class="container mt-4">
                <div class="table-responsive">
                    <a href="add_schedule.php" class="btn btn-success mb-3">Add Schedule</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Teacher ID</th>
                                <th>Student ID</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($schedule['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($schedule['teacher_id']);?></td>
                                    <td>
                                        <?php echo htmlspecialchars($schedule['student_id']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($schedule['day']); ?></td>
                                    <td><?php echo htmlspecialchars($schedule['start_time']);?></td>
                                    <td><?php echo htmlspecialchars($schedule['end_time']);?></td>
                                    <td><?php echo htmlspecialchars($schedule['room_number']);?></td>
                                    <td>
                                        <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>" class="btn btn-info">Edit</a>
                                        <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<?php require_once "includes/footer.php"; ?>