<?php 
    $title = 'Rooms Info | Safo Hall Pentvars';
    
    require_once 'includes/db_conn.php';
    
    $results = $crud->getRoomDetails();

    if (isset($_GET['lock'])) {
    $lockedRoomNumber = $_GET['lock'];
    $crud->lockRoomStatus($lockedRoomNumber);
    // Remove the lock parameter from the URL to prevent repeated updates on refresh
    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
    $queryParams = [];
    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $queryParams);
    }
    unset($queryParams['lock']);
    $newQuery = http_build_query($queryParams);
    $newUrl = $parsedUrl['path'] . (!empty($newQuery) ? "?$newQuery" : "");

    echo "<script>window.location.href='$newUrl';</script>";
    exit; // stop further processing after redirect
}
// Handle Unlock
if (isset($_GET['unlock'])) {
    $roomNumber = $_GET['unlock'];
    $crud->unlockRoomStatus($roomNumber);
    // redirect to clean URL
    $redirectUrl = strtok($_SERVER['REQUEST_URI'], '?');
    header("Location: {$redirectUrl}");
    exit;
}
require_once 'includes/session.php';
require_once 'includes/header.php';
require_once 'includes/auth_check.php';


    // if(isset($_GET['lock']) && isset($_GET['max'])){
    //                     // echo "Hello";
    //                     $crud->updateRoomCurrentStudents($_GET['lock'], $_GET['max']);
    //                     // Get the current URL
    //                     $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];

    //                     // Parse and clear the parameter as before
    //                     $parsedUrl = parse_url($currentUrl);
    //                     $queryParams = [];
    //                     if (isset($parsedUrl['query'])) {
        //                         parse_str($parsedUrl['query'], $queryParams);
    //                     }
    //                     unset($queryParams['lock'], $queryParams['max']);
    //                     $newQuery = http_build_query($queryParams);
    
    //                     // Build the new URL
    //                     $newUrl = $parsedUrl['scheme'] . "://" . $parsedUrl['host'] . $parsedUrl['path'];
    //                     if (!empty($newQuery)) {
    //                         $newUrl .= "?" . $newQuery;
    //                     }

    //                     // Redirect to the new URL
    //                     echo "<script>window.location.href='$newUrl'</script>";
    //                 }

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
                <th>Room Name</th>
                <th>Current Students</th>
                <th>Maximum Students</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
         while($r = $results->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
                <td><?php echo $r['room_id'] ?></td>
                <td><?php echo $r['room_number'] ?></td>
                <td><?php echo $r['room_name'] ?></td>
                <td><?php echo $r['current_students'] ?></td>
                <td><?php echo $r['max_students'] ?></td>
                <td><?php echo $r['status'] ?></td>
                <td>
                    <a title="Edit" href="editRoom?no=<?php echo $r['room_number'] ?>" class="btn btn-success">Edit<i class="ms-2 bi bi-pencil-square"></i></a>
                    <?php if ($r['status'] === 'locked'): ?>
                        <!-- Unlock button -->
                        <a title="Unlock"
                        href="viewRooms?unlock=<?php echo $r['room_number']; ?>"
                        class="btn btn-primary">
                        <i class="bi bi-unlock-fill"></i> Unlock
                        </a>
                    <?php else: ?>
                        <!-- Lock button -->
                        <a title="Lock"
                        href="viewRooms?lock=<?php echo $r['room_number']; ?>"
                        class="btn btn-warning">
                        <i class="bi bi-lock-fill"></i> Lock
                        </a>
                    <?php endif; ?>
                    <!-- <a title="Delete" onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $r['room_id'] ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a> -->
                    <!-- <input type="text" value="<?php echo $r['room_number'] ?>" id="lock_room_number" hidden> -->
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
<script defer src="js/rooms.js"></script>
<?php require_once 'includes/footer.php' ?>