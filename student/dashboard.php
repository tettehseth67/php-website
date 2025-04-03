<?php
session_start(); // Ensure session starts at the beginning

require_once "../student/includes/header.php";
require_once "../db/db_conn.php";

// Ensure user is logged in as a student
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "student") {
    header("Location: ../login.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../student/view_attendance.php">
                            <span data-feather="check-square"></span>
                            Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../student/view_schedule.php">
                            <span data-feather="calendar"></span>
                            Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../student/view_grades.php">
                            <span data-feather="book"></span>
                            Grades
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Student Dashboard</h1>
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
                <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">View Attendance</h5>
                                <p class="card-text">Check your attendance records.</p>
                                <a href="../student/view_attendance.php" class="btn btn-light">Go to Attendance</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">View Schedule</h5>
                                <p class="card-text">See your class schedules.</p>
                                <a href="../student/view_schedule.php" class="btn btn-light">Go to Schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php require_once "../student/includes/footer.php"; ?>