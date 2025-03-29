<?php
include_once 'includes/session.php'; // Include session management file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - <?php echo $title ?></title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/main.css">

    <!-- JQUERY UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    $page = basename($_SERVER['PHP_SELF']);
    if ($page == "register.php" || $page == "login.php" || $page == "submit_registration.php" || $page == "forgot_password.php" || $page == "login_success.php") {
    ?>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" aria-label="Primary navigation">
            <div class="container">
                <a class="navbar-brand" href="index.php">IT Company</a>
            </div>
        </nav>
    <?php } else { ?>
        <header>
            <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" aria-label="Primary navigation">
                <div class="container">
                    <a class="navbar-brand" href="index.php">IT Company</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="attendees.php">View Attendees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="students.php">Students</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <?php if (isset($_SESSION['username'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="register.php">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    <?php } ?>

    <div class="container">