<?php
$title = 'Edit Room';

require_once 'includes/session.php';
require_once 'includes/header.php';
require_once 'includes/auth_check.php';
require_once 'includes/db_conn.php';
$roomNumber = $currentStudents = $maxStudents = '';
if(isset($_POST['submit'])){
    if(!empty($_POST['room_number'])){
        $roomNumber = $_POST['room_number'];
    }
    if(!empty($_POST['current_students'])){
        $currentStudents = $_POST['current_students'];
    }
    if(!empty($_POST['max_students'])){
        $maxStudents = $_POST['max_students'];
    }
    

    $result = $crud->updateRoomDetails($roomNumber, $currentStudents, $maxStudents);
    if($result){
        echo "<script>window.location.href='viewRooms.php'</script>";;
    }else{
        include 'includes/errMessage.php';
    }
}

    if(!isset($_GET['no'])){
        include 'includes/errMessage.php';
    }
    else{
        $roomNumber = $_GET['no'];
        $roomInfo = $crud->getRoomDetailsByRoomNumber($roomNumber);
?>


    <main class="pt-3">
        <h2 class="text-center"><?php echo $title ?></h2>
        <div class="d-flex justify-content-center justify-content-center">
            <form action="editRoom.php" method="post" id="register_form" class="form py-3 px-5 rounded-3 shadow-lg bg-white needs-validation" novalidate>
                <input type="hidden" name="room_number" value="<?php echo $roomInfo['room_number'] ?>">
                <div style="font-weight: bold;" class="my-3">Room Number: <?php echo $roomInfo['room_number'] ?></div>
                <div>
                    <label for="current_student" class="form-label">Current Students</label>
                    <div>
                        <input type="text" name="current_students" id="current_students" value="<?php echo $roomInfo['current_students'] ?>" class="form-control pe-5" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="max_students" class="form-label">Maximum Students</label>
                    <div>
                        <input type="text" name="max_students" id="max_students" value="<?php echo $roomInfo['max_students'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="viewRooms.php" class="btn btn-info me-3">Back To List</a>
                    <input type="submit" name="submit" value="Save Changes" class="btn btn-success">
                </div>
            </form>
        </div>
    </main>
<?php } ?>
<br>
<br>
<?php require_once './includes/footer.php';?>