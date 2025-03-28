<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - <?php echo $title ?></title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>

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
            <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" aria-label="Main navigation">
                <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                    data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="#">Sign out</a>
                    </li>
                </ul>
            </nav>
        </header>
    <?php } ?>
