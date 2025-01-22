<?php
$title = 'Edit Record | Safo Hall Pentvars';

require_once 'includes/session.php';
require_once 'includes/header.php';
require_once 'includes/auth_check.php';
require_once 'includes/db_conn.php';
require_once 'includes/errorToast.php';

$id = $firstName = $lastName = $studentId = $category = $level = $programme = $contact = $email = $parentName = $parentContact = $physicallyChallenged = $disability = $underScholarship = $scholarshipSpecify = $area = $roomNumber = '';
$roomResults = $crud->getRoomDetails();
if (isset($_POST['submit'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (!empty($_POST['first_name'])) {
        $firstName = $_POST['first_name'];
    }
    if (!empty($_POST['last_name'])) {
        $lastName = $_POST['last_name'];
    }
    if (!empty($_POST['student_id'])) {
        $studentId = $_POST['student_id'];
    }
    if (!empty($_POST['category'])) {
        $category = $_POST['category'];
    }
    if (!empty($_POST['programme'])) {
        $programme = $_POST['programme'];
    }
    if (!empty($_POST['level'])) {
        $level = $_POST['level'];
    }
    if (!empty($_POST['contact'])) {
        $contact = $_POST['contact'];
    }
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (!empty($_POST['parent_name'])) {
        $parentName = $_POST['parent_name'];
    }
    if (!empty($_POST['parent_contact'])) {
        $parentContact = $_POST['parent_contact'];
    }
    if (!empty($_POST['disability'])) {
        $disability = $_POST['disability'];
    } else {
        $disability = 'None';
    }
    if ($_POST['is_under_scholarship'] == 'Yes' && $_POST['scholarship'] != 'others') {
        $scholarshipSpecify = $_POST['scholarship'];
        if ($_POST['scholarship'] == 'Church Of Pentecost') {
            $area = $_POST['specified_area'];
        } else {
            $area = 'None';
        }
    } else if ($_POST['is_under_scholarship'] == 'No') {
        $scholarshipSpecify = 'None';
        $area = 'None';
    } else {
        $scholarshipSpecify = $_POST['specified_scholarship'];
    }
    if (!empty($_POST['old_room_number'])) {
        $oldRoomNumber = $_POST['old_room_number'];
    }
    if (!empty($_POST['new_room_number'])) {
        $newRoomNumber = $_POST['new_room_number'];
    }

    $result = $crud->editStudentDetails($id, $firstName, $lastName, $studentId, $category, $level, $programme, $contact, $email, $parentName, $parentContact, $disability, $scholarshipSpecify, $area, $oldRoomNumber, $newRoomNumber);
    if ($result['success']) {
        echo "<script>window.location.href='viewRegisteredStudents'</script>";
    } else {
        displayErrorToast($result['message']);
    }
}

if (!isset($_GET['id'])) {
    include 'includes/errMessage.php';
} else {
    $id = $_GET['id'];
    $studentInfo = $crud->getSingleStudentDetails($id);
?>


    <main class="pt-3">
        <h2 class="text-center">Edit Record</h2>
        <div class="d-flex justify-content-center justify-content-center">
            <form action="edit" method="post" id="register_form" class="form py-3 px-5 rounded-3 shadow-lg bg-white needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php echo $studentInfo['id'] ?>">
                <div>
                    <label for="first_name" class="form-label">First Name</label>
                    <div>
                        <input type="text" name="first_name" id="first_name" value="<?php echo $studentInfo['first_name'] ?>" class="form-control pe-5" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="last_name" class="form-label">Last Name</label>
                    <div>
                        <input type="text" name="last_name" id="last_name" value="<?php echo $studentInfo['last_name'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="student_id" class="form-label">Student ID</label>
                    <div>
                        <input type="text" name="student_id" id="student_id" value="<?php echo $studentInfo['student_id'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="category" class="form-label">Category</label>
                    <div>
                        <select name="category" id="category" class="form-select" required>
                            <option selected disabled value="">Select Category</option>
                            <option value="undergraduate" <?php echo ($studentInfo['category'] == 'undergraduate') ? 'selected' : '' ?>>Undergraduate</option>
                            <option value="abe" <?php echo ($studentInfo['category'] == 'abe') ? 'selected' : '' ?>>ABE</option>
                            <option value="ncce" <?php echo ($studentInfo['category'] == 'ncce') ? 'selected' : '' ?>>NCCE</option>
                        </select>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="programme" class="form-label">Programme</label>
                    <div>
                        <select name="programme" type="text" class="form-select" required>
                            <option selected disabled value="">Select Programme</option>
                            <option value="B.Sc. Actuarial Science" <?php echo ($studentInfo['programme'] == 'B.Sc. Actuarial Science') ? 'selected' : '' ?>>B.Sc. Actuarial Science</option>
                            <option value="B.Sc. Quantity Surveying and Building Economics" <?php echo ($studentInfo['programme'] == 'B.Sc. Quantity Surveying and Building Economics') ? 'selected' : '' ?>>B.Sc. Quantity Surveying and Building Economics</option>
                            <option value="B.A. Communication Studies" <?php echo ($studentInfo['programme'] == 'B.A. Communication Studies') ? 'selected' : '' ?>>B.A. Communication Studies</option>
                            <option value="Association of Business Executives (ABE)" <?php echo ($studentInfo['programme'] == 'Association of Business Executives (ABE)') ? 'selected' : '' ?>>Association of Business Executives (ABE)</option>
                            <option value="National Centre for Computer Education (NCCE)" <?php echo ($studentInfo['programme'] == 'National Centre for Computer Education (NCCE)') ? 'selected' : '' ?>>National Centre for Computer Education (NCCE)</option>
                            <option value="B.Eng Pre-Engineering" <?php echo ($studentInfo['programme'] == 'B.Eng Pre-Engineering') ? 'selected' : '' ?>>B.Eng Pre-Engineering</option>
                            <option value="Bachelor of Laws (LL.B)" <?php echo ($studentInfo['programme'] == 'Bachelor of Laws (LL.B)') ? 'selected' : '' ?>>Bachelor of Laws (LL.B)</option>
                            <option value="B.Sc. Physician Assistantship Studies - Medical" <?php echo ($studentInfo['programme'] == 'B.Sc. Physician Assistantship Studies - Medical') ? 'selected' : '' ?>>B.Sc. Physician Assistantship Studies - Medical</option>
                            <option value="B.Sc. Business Administration (Accounting)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Accounting)') ? 'selected' : '' ?>>B.Sc. Business Administration (Accounting)</option>
                            <option value="B.Sc. Industrial Software Engineering" <?php echo ($studentInfo['programme'] == 'B.Sc. Industrial Software Engineering') ? 'selected' : '' ?>>B.Sc. Industrial Software Engineering</option>
                            <option value="B.Sc. Business Administration (Banking & Finance)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Banking & Finance)') ? 'selected' : '' ?>>B.Sc. Business Administration (Banking & Finance)</option>
                            <option value="Bachelor of Commerce (Accounting with Computing)" <?php echo ($studentInfo['programme'] == 'Bachelor of Commerce (Accounting with Computing)') ? 'selected' : '' ?>>Bachelor of Commerce (Accounting with Computing)</option>
                            <option value="B.Sc. Business Administration (Corporate & Business Development Studies)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Corporate & Business Development Studies)') ? 'selected' : '' ?>>B.Sc. Business Administration (Corporate & Business Development Studies)</option>
                            <option value="B.Sc. Business Administration (Human Resource Management)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Human Resource Management)') ? 'selected' : '' ?>>B.Sc. Business Administration (Human Resource Management)</option>
                            <option value="B.Sc. Business Administration (Insurance with Actuarial Science)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Insurance with Actuarial Science)') ? 'selected' : '' ?>>B.Sc. Business Administration (Insurance with Actuarial Science)</option>
                            <option value="B.Sc. Business Administration (Logistics and Supply Chain Management)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Logistics and Supply Chain Management)') ? 'selected' : '' ?>>B.Sc. Business Administration (Logistics and Supply Chain Management)</option>
                            <option value="B.Sc. Business Administration (Marketing)" <?php echo ($studentInfo['programme'] == 'B.Sc. Business Administration (Marketing)') ? 'selected' : '' ?>>B.Sc. Business Administration (Marketing)</option>
                            <option value="B.Sc. Construction Technology and Engineering Management" <?php echo ($studentInfo['programme'] == 'B.Sc. Construction Technology and Engineering Management') ? 'selected' : '' ?>>B.Sc. Construction Technology and Engineering Management</option>
                            <option value="B.Sc. Information Technology" <?php ($studentInfo['programme'] == 'B.Sc. Information Technology') ? 'selected' : '' ?>>B.Sc. Information Technology</option>
                            <option value="B.Sc. Nursing" <?php echo ($studentInfo['programme'] == 'B.Sc. Nursing') ? 'selected' : '' ?>>B.Sc. Nursing</option>
                            <option value="B.Eng Robotics and Automation" <?php echo ($studentInfo['programme'] == 'B.Eng Robotics and Automation') ? 'selected' : '' ?>>B.Eng Robotics and Automation</option>
                            <option value="B.Eng Electricals and Electronics Engineering" <?php echo ($studentInfo['programme'] == 'B.Eng Electricals and Electronics Engineering') ? 'selected' : '' ?>>B.Eng Electricals and Electronics Engineering</option>
                            <option value="B.Sc Health Information"<?php echo ($studentInfo['programme'] == 'B.Sc Health Information') ? 'selected' : '' ?>>B.Sc Health Information</option>
                        </select>
                        <div class="invalid-feedback">Please choose a valid programme</div>
                    </div>
                </div>
                <div>
                    <label for="level" class="form-label">Level</label>
                    <div>
                        <select name="level" id="level" class="form-select" required>
                            <option selected disabled value="">Choose level</option>
                            <option value="100" <?php echo ($studentInfo['level'] == '100') ? 'selected' : '' ?>>100</option>
                            <option value="200" <?php echo ($studentInfo['level'] == '200') ? 'selected' : '' ?>>200</option>
                            <option value="300" <?php echo ($studentInfo['level'] == '300') ? 'selected' : '' ?>>300</option>
                            <option value="400" <?php echo ($studentInfo['level'] == '400') ? 'selected' : '' ?>>400</option>
                            <option value="400" <?php echo ($studentInfo['level'] == '4') ? 'selected' : '' ?>>4</option>
                            <option value="400" <?php echo ($studentInfo['level'] == '5') ? 'selected' : '' ?>>5</option>
                            <option value="400" <?php echo ($studentInfo['level'] == '6') ? 'selected' : '' ?>>6</option>
                        </select>
                        <div class="invalid-feedback">Please choose a valid level</div>
                    </div>
                </div>
                <div>
                    <label for="contact" class="form-label">Contact</label>
                    <div>
                        <input name="contact" type="number" value="<?php echo $studentInfo['contact'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid contact</div>
                    </div>
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <div>
                        <input name="email" type="email" value="<?php echo $studentInfo['email'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid email</div>
                    </div>
                </div>
                <div>
                    <label for="parent_name" class="form-label">Parent's name</label>
                    <div>
                        <input name="parent_name" type="text" value="<?php echo $studentInfo['parent_name'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter valid input</div>
                    </div>
                </div>
                <div>
                    <label for="parent_contact" class="form-label">Parent's Contact</label>
                    <div>
                        <input name="parent_contact" id="parent_contact" type="number" value="<?php echo $studentInfo['parent_contact'] ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid contact</div>
                    </div>
                </div>
                <div>
                    <label for="is_under_scholarship" class="form-label">Are you physically challenged?</label>
                    <div>
                        <input name="is_challenged" type="radio" class="" id="challenged" value="Yes" <?php echo ($studentInfo['physical_challenges'] == 'None') ? '' : 'checked' ?> required>Yes<br>
                        <input name="is_challenged" type="radio" class="" id="not_challenged" value="No" <?php echo ($studentInfo['physical_challenges'] == 'None') ? 'checked' : '' ?> required>No
                        <div class="invalid-feedback">Please enter valide input</div>
                    </div>
                </div>
                <div class="specify_disability_container">
                    <label for="disability" class="form-label">Please Specify</label>
                    <div>
                        <input name="disability" id="disability" type="text" value="<?php echo $studentInfo['physical_challenges'] ?>" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="is_under_scholarship" class="form-label">Are you under scholarship?</label>
                    <div>
                        <input name="is_under_scholarship" type="radio" class="" id="under_scholarship" value="Yes" <?php echo ($studentInfo['scholarship'] == 'None') ? '' : 'checked' ?> required>Yes<br>
                        <input name="is_under_scholarship" type="radio" class="" id="not_under_scholarship" value="No" <?php echo ($studentInfo['scholarship'] == 'None') ? 'checked' : '' ?> required>No
                        <div class="invalid-feedback">Please choose a valid choice</div>
                    </div>
                </div>
                <div>
                    <div class="choose_scholarship_container">
                        <label for="scholarship" class="form-label">Scholarship</label>
                        <select name="scholarship" id="scholarship_select" class="form-select" required>
                            <option value="choose_scholarship" selected disabled>Choose Scholarship</option>
                            <option value="Church Of Pentecost" <?php echo ($studentInfo['scholarship'] == 'Church Of Pentecost') ? 'selected' : '' ?>>Church of Pentecost</option>
                            <option value="COPCEF" <?php echo ($studentInfo['scholarship'] == 'COPCEF') ? 'selected' : '' ?>>COPCEF</option>
                            <option value="Pentecost University" <?php echo ($studentInfo['scholarship'] == 'Pentecost University') ? 'selected' : '' ?>>Pentecost University</option>
                            <option value="Get Fund" <?php echo ($studentInfo['scholarship'] == 'Get Fund') ? 'selected' : '' ?>>GET Fund</option>
                            <option value="others" <?php echo ($studentInfo['scholarship'] == 'others') ? 'selected' : '' ?>>Others(Please Specify)</option>
                        </select>
                        <div class="invalid-feedback">Please choose a valid choice</div>
                        <div class="" id="specify_scholarship_container">
                            <label for="specified_scholarship">Specify Scholarship</label>
                            <div>
                                <input type="text" name="specified_scholarship" id="specified_scholarship" value="<?php echo $studentInfo['scholarship'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="" id="specify_area_container">
                            <label for="specified_area">Specify Area</label>
                            <div>
                                <input type="text" name="specified_area" id="specified_area" value="<?php echo $studentInfo['area'] ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="form-control btn btn-outline-primary" id="choose_room_btn" data-bs-toggle="modal" data-bs-target="#choose_room_modal_container">Choose Room</button>
                </div>
                <div id="choose_room_modal_container" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Choose Room</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                while ($r = $roomResults->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<button type="button" value="' . $r['room_number'] . '" class="btn btn-outline-primary m-2 room-button ';
                                    if ($r['current_students'] == $r['max_students']) {
                                        echo 'disabled bg-secondary';
                                    }
                                    echo '" onClick = "updateRoomNumber(' . $r["room_number"] . ')">' . $r['room_number'] . '</button>';
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary modal-submit-btn" data-bs-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <label for="room_number" class="form-label">Room Number &nbsp;</label>
                    <span class="" id="room_num_display" value="<?php echo $studentInfo['room_number'] ?>"><?php echo $studentInfo['room_number'] ?></span>
                    <div>
                        <input type="hidden" name="old_room_number" id="old_room_number" value="<?php echo $studentInfo['room_number'] ?>" class="form-control">
                        <input type="hidden" name="new_room_number" id="new_room_number" value="<?php echo $studentInfo['room_number'] ?>" class="form-control">

                        <div class="invalid-feedback">Please select a room</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="viewRegisteredStudents" class="btn btn-info me-3">Back To List</a>
                    <input type="submit" name="submit" value="Save Changes" class="btn btn-success">
                </div>
            </form>
        </div>
    </main>
<?php } ?>
<br>
<br>
<?php require_once './includes/footer.php'; ?>
<script>
    let selectedRoom = '';

    function updateRoomNumber(roomNumber) {
        selectedRoom = roomNumber;
    }

    document.querySelector('.modal-submit-btn').addEventListener('click', function() {
        document.getElementById('new_room_number').value = selectedRoom;
        document.getElementById('room_num_display').innerText = selectedRoom;
        document.getElementById('room_number').value = selectedRoom;
    });
</script>
<script defer src="js/edit_script.js"></script>