<?php
$title = 'Registration';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

$results = $course->getCourse();

?>

<div class="container px-3 py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Create Student</h1>

            <form action="student_success.php" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" aria-label="First name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" aria-label="Last name">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dateofbirth" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control" id="dateofbirth" name="dateofbirth">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Area of Expertise:</label>
                    <select class="form-select" aria-label="Default select example" name="course" id="course">
                        <?php foreach($results as $course) { ?>
                            <option value="<?php echo $course['course_id'];?>">
                                <?php echo $course['name'];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="emailaddress" name="emailaddress">
                </div>
                <div class="mb-3">
                    <label for="phonenumber" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="phoneHelp">
                    <small id="phoneHelp" class="form-text text-muted text-light">
                        Please enter a valid phone number in the format XXX-XXX-XXXX.
                    </small>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Create Stusent</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>