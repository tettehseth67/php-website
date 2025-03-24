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
    <div class="container py-4 mx-auto">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-3">
                    <?php echo htmlspecialchars($attendee['fname'] . " " . $attendee['lname']); ?>
                </h3>
                <h6 class="card-subtitle mb-3 text-body-secondary text-center">
                    <?php echo htmlspecialchars($attendee['name']); ?>
                </h6>
                <hr>
                <p class="mb-3"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($attendee['dob']); ?></p>
                <p class="mb-3"><strong>Email:</strong> <?php echo htmlspecialchars($attendee['email']); ?></p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-center mt-4">
            <a href="attendees.php" class="btn btn-secondary me-2">Back</a>
            <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning me-2">Edit</a>

            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Delete
            </button>
        </div>
    </div>

    <!-- Bootstrap Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php
require 'includes/footer.php';
?>