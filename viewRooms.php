<?php 
    $title = 'Rooms Info';
    
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getRoomDetails();
?>

<div class="container-xxl w-100">
    <div>
        <h3 class="my-3 text-center">All Rooms</h3>
    </div>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Room Number</th>
                <th>Current Students</th>
                <th>Maximum Students</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
         while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td><?php echo $r['room_id'] ?></td>
                <td><?php echo $r['room_number'] ?></td>
                <td><?php echo $r['current_students'] ?></td>
                <td><?php echo $r['max_students'] ?></td>
                <td>
                    <a title="Edit" href="editRoom.php?no=<?php echo $r['room_number'] ?>" class="btn btn-success">Edit<i class="ms-2 bi bi-pencil-square"></i></a>
                    <a title="Lock" href="" class="btn btn-warning"><i class="bi bi-lock-fill"></i></a>
                    <!-- <a title="Delete" onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $r['id'] ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a> -->
                </td>
            </tr>
        <?php
            } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Options',
                className: 'custom-html-collection',
                buttons: [
                    '<h3>Export</h3>',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    'csv',
                    'excel',
                    '<h3 class="not-top-heading">Column Visibility</h3>',
                    {
                        extend: 'colvis',
                        collectionLayout: 'fixed columns',
                        collectionTitle: 'Column visibility control'
                    }
                ]
            }
        ]
    });
} );
</script>
<?php require_once 'includes/footer.php' ?>