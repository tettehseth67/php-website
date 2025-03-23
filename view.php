<?php
$title = 'View Records';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// get all records by id
if (!isset($_GET['$id'])) {
    echo '<div class="alert alert-danger" role="alert">No record found!</div>';
    exit();
} else {
    $id = $_GET['$id'];
    $attendee = $crud->getAttendeesById($id);

?>

<!-- Main Content -->
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?php echo $attendee['fname'] . " " . $attendee['lname']; ?>
        </h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">
            <?php echo $attendee['name']; ?>
        </h6>
        <p class="card-text">
            <?php echo $attendee['dob']; ?>
        </p>
        <p class="card-text">
            <?php echo $attendee['email']; ?>
        </p>
    </div>
</div>

<?php } ?>

<?php
require 'includes/footer.php';
?>