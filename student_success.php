<?php
$title = 'Home Page';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Check if the form has been submitted
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $specialty = $_POST['specialty'];

        $isSuccess = $student->insertStudents($fname, $lname, $dob, $email, $phone, $specialty);
        if ($isSuccess) {
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Failed to register. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
?>

<?php require_once 'includes/footer.php' ?>