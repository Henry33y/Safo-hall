<?php
    $title = 'Student Info';
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    $results = $crud->getStudentInfo();
?>

<div class="container-xl">
    <div class="d-flex justify-content-between">
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if(isset($_SESSION['username'])){ ?>
                    <span><i class="bi bi-person-circle me-2"></i>Hello <?php echo ucwords($_SESSION['username']) ?> !</span>
                <?php } ?>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="adduser.php"><i class="bi bi-person-add me-2"></i>Add User</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power me-2"></i>Logout</a></li>
            </ul>
        </div>
        <a href="viewRooms.php" class="me-md-5 btn btn-secondary" style="font-size: 0.9em;">View Rooms Info</a>
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
                    <td>
                        <a href="view.php?id=<?php echo $r['id'] ?>" class="btn btn-primary">View</a>
                        <a href="edit.php?id=<?php echo $r['id'] ?>" class="btn btn-warning">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $r['id'] ?>" class="btn btn-danger">Delete</a>
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