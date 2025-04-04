<?php
// Include session file to manage user sessions
include_once __DIR__ . "/session.php";

$page = basename($_SERVER['PHP_SELF']); // Get current page name
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/site.css" />

    <title>Attendance - <?php echo isset($title) ? $title : "System"; ?></title>
</head>

<body>

    <?php if ($page == 'login.php' || $page == 'register.php') : ?>
        <!-- Minimal Navbar for Login & Register Pages -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand ms-auto" href="index.php">Attendance System</a>
        </nav>
    <?php else : ?>
        <!-- Full Navbar for Other Pages -->
        <nav class="navbar navbar-expand-lg
            <?php echo ($page == 'index.php') ? 'navbar-dark bg-primary' : 'navbar-light bg-light'; ?>">
            <a class="navbar-brand" href="index.php">Attendance</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link <?php echo ($page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    <a class="nav-item nav-link <?php echo ($page == 'attendees.php') ? 'active' : ''; ?>" href="attendees.php">View Attendees</a>
                </div>

                <div class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION['userid'])) { ?>
                        <?php if ($page !== 'login.php') { ?>
                            <a class="nav-item nav-link" href="login.php">Login</a>
                        <?php } ?>
                        <?php if ($page !== 'register.php') { ?>
                            <a class="nav-item nav-link" href="register.php">Register</a>
                        <?php } ?>
                    <?php } else { ?>
                        <a class="nav-item nav-link" href="#">
                            Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                        </a>
                        <a class="nav-item nav-link text-danger" href="logout.php">Logout</a>

                        <!-- Redirect based on the user role -->
                        <?php if (isset($_SESSION['role'])): ?>
                            <?php
                            $domain = $_SESSION['role'] . ".yourdomain.com"; // Construct the subdomain based on user role
                            $redirect_url = "http://" . $domain . "/php-website/" . strtolower($_SESSION['role']) . "/dashboard.php"; // Direct to dashboard for the role
                            ?>
                            <a class="nav-item nav-link" href="<?php echo $redirect_url; ?>">
                                Go to <?php echo ucfirst($_SESSION['role']); ?> Dashboard
                            </a>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <div class="container">