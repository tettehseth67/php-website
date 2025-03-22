<?php
$title = 'Login';
require_once 'includes/header.php';

?>

<div class="container">
    <h1 class="text-center m-3">Registration for IT Conference</h1>

    <form action="submit_registration.php" method="get">
        <div class="mb-3">
            <label for="email" class="form-label">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>