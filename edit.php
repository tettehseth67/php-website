<?php
$title = 'Edit Records';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

$results = $crud->getSpecialties();

// Get the selected record
if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger" role="alert">No record found!</div>';
    exit();
} else {
    $id = $_GET['id'];
    $attendee = $crud->getAttendeesById($id);


?>

<div class="container px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Edit Records</h1>

            <form action="editPost.php" method="post">
                <input type="hidden" name="id" value="<?php echo $attendee['attendee_id'];?>"/>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" aria-label="First name" value="<?php echo $attendee['fname']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" aria-label="Last name" value="<?php echo $attendee['lname']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $attendee['dob']; ?>">
                </div>
                <div class="mb-3">
                    <label for="specialty" class="form-label">Area of Expertise:</label>
                    <select class="form-select" aria-label="Default select example" name="specialty" id="specialty">
                        <?php foreach ($results as $specialty) { ?>
                            <option value="<?php echo $specialty['specialty_id']; ?>" <?php if ($attendee['specialty_id'] == $specialty['specialty_id']) echo 'selected'; ?>>
                                <?php echo $specialty['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $attendee['email']; ?>">
                    <div id="emailHelp" class="form-text text-muted text-light">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
                    <small id="phoneHelp" class="form-text text-muted text-light">
                        Please enter a valid phone number in the format XXX-XXX-XXXX.
                    </small>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success" name="submit">Edit Records</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php require_once 'includes/footer.php'; ?>