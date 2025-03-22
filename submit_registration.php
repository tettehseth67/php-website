<?php
$title = 'Home Page';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Check if the form has been submitted
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $phone = $_POST['phone'];
        $specialty = $_POST['specialty'];
        
        $isSuccess = $crud->insert($fname, $lname, $email, $dob, $phone, $specialty);
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

<div class="container">
    <?php
    // Display success message
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your registration was successful.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    ?>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $_POST['fname'] . " " . $_POST['lname']; ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
                <?php echo $_POST['email'];?>
            </h6>
            <p class="card-text">
                <?php echo $_POST['dob'];?>
            </p>
            <p class="card-text">
                <?php echo $_POST['specialty'];?>
            </p>
        </div>
    </div>
</div>


<?php
require_once 'includes/footer.php';
?>