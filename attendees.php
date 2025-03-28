<?php
$title = 'Attendees';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Get all attendees
$results = $crud->getAttendees();

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1
$offset = ($page - 1) * $limit;

// Get total number of attendees
//$total_results = $crud->getTotalAttendees(); // Create this function to count total attendees
//$total_pages = ceil($total_results / $limit);

// Fetch attendees for the current page
//$results = $crud->getAttendeesPaginated($limit, $offset); // Create this function to get limited records

?>

<!-- Main content -->
<div class="container">
    <h1 class="text-center py-3">Attendees</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <a href="details.php" class="btn btn-primary float-right">Add Attendee</a>
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Email Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Specialty</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $key =>  $value) { ?>
                <tr>
                    <th scope="row"><?php echo $offset + $key + 1; ?></th>
                    <td><?php echo $value['fname']; ?></td>
                    <td><?php echo $value['lname']; ?></td>
                    <td><?php echo $value['dob']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['phone']; ?></td>
                    <td><?php echo $value['name'] ; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $value['attendee_id'] ?>" class="btn btn-success">View</a>
                        <a href="edit.php?id=<?php echo $value['attendee_id'] ?>" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $value['attendee_id']; ?>">
                            Delete
                        </button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $value['attendee_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                        <a href="delete.php?id=<?php echo $value['attendee_id']; ?>" class="btn btn-danger">Yes, Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <!-- <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">Next</a>
            </li>
        </ul>
    </nav> -->
</div>

<?php require_once 'includes/footer.php'; ?>
