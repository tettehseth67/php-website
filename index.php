<?php // Start the session
$title = 'Home Page';
require_once __DIR__ . '/includes/header.php';

?>

<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>

                    <?php if ($_SESSION["role"] === "admin"): ?>
                        <p>You have administrative privileges.</p>
                        <a href="admin_dashboard.php" class="btn btn-primary">Admin Dashboard</a>

                    <?php elseif ($_SESSION["role"] === "teacher"): ?>
                        <p>Welcome, Teacher! Manage your students and courses.</p>
                        <a href="teacher_dashboard.php" class="btn btn-primary">Teacher Dashboard</a>

                    <?php elseif ($_SESSION["role"] === "student"): ?>
                        <p>Welcome, Student! View your assignments and progress.</p>
                        <a href="student_dashboard.php" class="btn btn-primary">Student Portal</a>

                    <?php endif; ?>

                <?php else: ?>
                    <h1>Welcome to Our Platform</h1>
                    <p>Join as a student, teacher, or administrator.</p>
                    <a href="register.php" class="btn btn-primary">Register</a>
                    <a href="login.php" class="btn btn-secondary">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>