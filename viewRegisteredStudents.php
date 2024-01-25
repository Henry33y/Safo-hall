<?php
    $title = 'View';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getStudentInfo();
?>
<div class="table-responsive m-4">
    <table class="table table-striped table-responsive">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Student ID</th>
            <th>Category</th>
            <th>Level</th>
            <th>Programme</th>
            <th>Room Number</th>
            <th>Actions</th>
        </tr>
        <?php
        // $count_id = 1;
         while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td><?php echo $r['id'] ?></td>
                <td><?php echo $r['first_name'] ?></td>
                <td><?php echo $r['last_name'] ?></td>
                <td><?php echo $r['student_id'] ?></td>
                <td><?php echo $r['category'] ?></td>
                <td><?php echo $r['level'] ?></td>
                <td><?php echo $r['programme'] ?></td>
                <td><?php echo $r['room_number'] ?></td>
                <td>
                    <a href="view.php?id=<?php echo $r['id'] ?>" class="btn btn-primary">View</a>
                    <a href="edit.php?id=<?php echo $r['id'] ?>" class="btn btn-warning">Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $r['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php
            // $count_id++;
            } ?>
    </table>
</div>


<?php require_once 'includes/footer.php' ?>