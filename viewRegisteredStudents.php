<?php
    $title = 'Student Info | Safo Hall Pentvars';
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getStudentInfo();
?>

<div class="container-xxl">
    <div class="d-flex justify-content-between">
        <h3 class="m-0 d-flex align-items-center">All Registered Students</h3>
        <a href="register" class="d-flex align-items-center btn btn-success" style="font-size: 0.9em;"><span class="d-md-inline d-none">Add New Student</span><i class="bi bi-plus ms-md-2 fs-4"></i></a>
    </div>
    <div class="py-3">
        <table id="myTable" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Student ID</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Programme</th>
                    <th>Room Number</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Parent Name</th>
                    <th>Parent Contact</th>
                    <th>Physical Challenges</th>
                    <th>Scholarship</th>
                    <th>Registered on</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    
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
                    <td><?php echo $r['email'] ?></td>
                    <td><?php echo $r['contact'] ?></td>
                    <td><?php echo $r['parent_name'] ?></td>
                    <td><?php echo $r['parent_contact'] ?></td>
                    <td><?php echo $r['physical_challenges'] ?></td>
                    <td><?php echo $r['scholarship'] ?></td>
                    <td><?php echo $r['registered_at'] ?></td>
                    <td style="font-size: 1.1em;">
                        <a title="View" href="view?id=<?php echo $r['id'] ?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                        <a title="Edit" href="edit?id=<?php echo $r['id'] ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a title="Delete" onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $r['id'] ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                </tr>
            <?php
                // $count_id++;
                } ?>
            </tbody>
        </table>
    </div>
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
        ],
        columnDefs: [
            {
                target: 4,
                visible: false,
                searchable: false
            },
            {
                target: 8,
                visible: false,
                searchable: false
            },
            {
                target: 9,
                visible: false,
                searchable: false
            },
            {
                target: 10,
                visible: false,
                searchable: false
            },
            {
                target: 11,
                visible: false,
                searchable: false
            },
            {
                target: 12,
                visible: false,
                searchable: false
            },
            {
                target: 13,
                visible: false,
                searchable: false
            },
            {
                target: 14,
                visible: false,
                searchable: false
            },
        ]
    });
} );
</script>


<?php require_once 'includes/footer.php' ?>