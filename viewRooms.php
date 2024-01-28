<?php 
    $title = 'View Rooms';
    
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getRoomDetails();
?>

<div class="table-responsive m-4">
    <table class="table table-striped table-responsive">
        <tr>
            <th>#</th>
            <th>Room Number</th>
            <th>Current Students</th>
            <th>Maximum Students</th>
        </tr>
        <?php
         while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td><?php echo $r['room_id'] ?></td>
                <td><?php echo $r['room_number'] ?></td>
                <td><?php echo $r['current_students'] ?></td>
                <td><?php echo $r['max_students'] ?></td>
            </tr>
        <?php
            } ?>
    </table>
</div>