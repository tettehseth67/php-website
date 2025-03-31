<?php
$title = 'Registration';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

$results = $crud->getSpecialties();

?>

<div class="container px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Attendee Details</h1>

            <form action="submit_registration.php" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" aria-label="First name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" aria-label="Last name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="specialty" class="form-label">Area of Expertise:</label>
                    <select class="form-select" aria-label="Default select example" name="specialty" id="specialty">
                        <?php foreach ($results as $specialty) { ?>
                            <option value="<?php echo $specialty['specialty_id']; ?>">
                                <?php echo $specialty['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" required>
                    <small id="phoneHelp" class="form-text text-muted text-light">
                        Please enter a valid phone number in the format XXX-XXX-XXXX.
                    </small>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Create Attendees</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once 'includes/footer.php'; ?>