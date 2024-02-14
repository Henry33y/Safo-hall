<?php 
    $title = 'Rooms Info';
    
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getRoomDetails();
?>

<div class="py-4 w-100">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Room Number</th>
                <th>Current Students</th>
                <th>Maximum Students</th>
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