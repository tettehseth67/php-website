<?php
$title = 'Registration';
require_once 'includes/header.php';

?>

<div class="container">
    <h1 class="text-center m-3">Registration for IT Conference</h1>

    <form action="submit_registration.php" method="get">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth:</label>
            <input type="text" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label">Area of Expertise:</label>
            <select class="form-select" aria-label="Default select example" name="specialty" id="specialty">
                <option value="">Select an option</option>
                <option value="1">Database Admin</option>
                <option value="2">Software Developer</option>
                <option value="3">Web Developer</option>
                <option value="4">Other</option>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>