<?php

require_once 'includes/header.php';

?>

<!-- Main content -->
    <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center m-3">Forget Password</h1>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require_once 'includes/footer.php';

?>