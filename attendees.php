<?php
$title = 'Attendees';
require_once 'includes/header.php';
require_once 'db/db_conn.php';

// Fetch all attendees
$results = $crud->getAttendees();
?>

<!-- Main content -->
<div class="container">
    <h1>Attendance</h1>
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
            <?php foreach ( $results as $key =>  $value ) { ?>
                <tr>
                    <th scope="row"><?php echo $key + 1;?></th>
                    <td><?php echo $value['fname'];?></td>
                    <td><?php echo $value['lname'];?></td>
                    <td><?php echo $value['dob'];?></td>
                    <td><?php echo $value['email'];?></td>
                    <td><?php echo $value['phone'];?></td>
                    <td><?php echo $value['name'];?></td>
                    <td>
                        <a href="view.php?$id=<?php echo $value['attendee_id']?>" class="btn btn-success">View</a>
                        <a href="edit.php?id=<?php echo $value['attendee_id'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are you sure you really want to delete this attendee record');" href="delete.php?id=<?php echo $value['attendee_id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<?php

require_once 'includes/footer.php';
?>