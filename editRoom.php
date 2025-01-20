<?php
$title = 'Edit Room | Safo Hall Pentvars';

require_once 'includes/session.php';
require_once 'includes/header.php';
require_once 'includes/auth_check.php';
require_once 'includes/db_conn.php';
require_once 'includes/errorToast.php';

$roomNumber = $currentStudents = $maxStudents = '';
if(isset($_POST['submit'])){
    $error = false;
    if(!empty($_POST['room_number'])){
        $roomNumber = $_POST['room_number'];
    }
    if(!empty($_POST['current_students'])){
        $currentStudents = $_POST['current_students'];
    }
    if(!empty($_POST['max_students'])){
        $maxStudents = $_POST['max_students'];
    }

    // Server-side validation
    if ($currentStudents > $maxStudents) {
        $error = true;
        displayErrorToast('Current students cannot exceed maximum students.');
    }

    if (!$error) {
        $result = $crud->updateRoomDetails($roomNumber, $currentStudents, $maxStudents);
        if($result['success']){
            echo "<script>window.location.href='viewRooms'</script>";
        } else {
            displayErrorToast('An error occurred. Please try again.');
        }
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
            <form action="editRoom" method="post" id="register_form" class="form py-3 px-5 rounded-3 shadow-lg bg-white needs-validation" novalidate>
                <input type="hidden" name="room_number" value="<?php echo $roomInfo['room_number'] ?>">
                <div style="font-weight: bold;" class="my-3">Room Number: <?php echo $roomInfo['room_number'] ?></div>
                <div>
                    <label for="current_student" class="form-label">Current Students</label>
                    <div>
                        <input type="number" name="current_students" id="current_students" value="<?php echo $roomInfo['current_students'] ?>" min="0" max="<?php echo $roomInfo['max_students'] ?>" class="form-control pe-5" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="max_students" class="form-label">Maximum Students</label>
                    <div>
                        <input type="number" name="max_students" id="max_students" value="<?php echo $roomInfo['max_students'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Maximum Students must not be empty</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="viewRooms" class="btn btn-info me-3">Back To List</a>
                    <input type="submit" name="submit" value="Save Changes" class="btn btn-success">
                </div>
            </form>
        </div>
    </main>
<?php } ?>
<br>
<br>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#register_form');
    const currentStudents = document.querySelector('#current_students');
    const maxStudents = document.querySelector('#max_students');
    const currentStudentsFeedback = currentStudents.nextElementSibling;

    // Function to validate current_students against max_students
    function validateStudents() {
        const current = parseInt(currentStudents.value, 10);
        const max = parseInt(maxStudents.value, 10);

        if (current > max) {
            currentStudents.setCustomValidity("Invalid");
            currentStudentsFeedback.textContent = "Current students cannot exceed maximum students.";
        } else {
            currentStudents.setCustomValidity("");
            currentStudentsFeedback.textContent = "Current students must not be empty"; // Reset default message if valid
        }
    }

    // Add input event listeners for validation
    currentStudents.addEventListener('input', validateStudents);
    maxStudents.addEventListener('input', validateStudents);

    // Bootstrap validation on form submission
    form.addEventListener('submit', (event) => {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated'); // Add Bootstrap validation styles
    });
});


</script>
<?php require_once './includes/footer.php';?>