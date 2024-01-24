<?php
    $title = 'View';
    require_once 'includes/header.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getStudentInfo();
?>
<div class="table-responsive">
    <table class="table table-striped table-responsive">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Student ID</th>
            <th>Category</th>
            <th>Level</th>
            <th>Programme</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Parent's name'</th>
            <th>Parent's contact'</th>
            <th>Disability</th>
            <th>Scholarships</th>
            <th>Room Number</th>
            <th>Registered at</th>
        </tr>
        <?php
        $count_id = 1;
         while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td><?php echo $count_id ?></td>
                <td><?php echo $r['first_name'] ?></td>
                <td><?php echo $r['last_name'] ?></td>
                <td><?php echo $r['student_id'] ?></td>
                <td><?php echo $r['category'] ?></td>
                <td><?php echo $r['level'] ?></td>
                <td><?php echo $r['programme'] ?></td>
                <td><?php echo $r['contact'] ?></td>
                <td><?php echo $r['email'] ?></td>
                <td><?php echo $r['parent_name'] ?></td>
                <td><?php echo $r['parent_contact'] ?></td>
                <td><?php echo $r['physical_challenges'] ?></td>
                <td><?php echo $r['scholarship'] ?></td>
                <td><?php echo $r['room_number'] ?></td>
                <td><?php echo $r['registered_at'] ?></td>
            </tr>
        <?php
            $count_id++;
            } ?>
    </table>
</div>