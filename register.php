<?php
$title = 'Register';
require_once './includes/header.php';
require_once 'includes/db_conn.php';
$firstName = $lastName = $studentId = $category = $level = $programme = $contact = $email = $parentName = $parentContact = $physicallyChallenged = $disability = $underScholarship = $scholarshipSpecify = $roomNumber = '';
$roomResults = $crud->getRoomDetails();
if(isset($_POST['submit'])){
    if(!empty($_POST['first_name'])){
        $firstName = $_POST['first_name'];
    }
    if(!empty($_POST['last_name'])){
        $lastName = $_POST['last_name'];
    }
    if(!empty($_POST['student_id'])){
        $studentId = $_POST['student_id'];
    }
    if(!empty($_POST['category'])){
        $category = $_POST['category'];
    }
    if(!empty($_POST['programme'])){
        $programme = $_POST['programme'];
    }
    if(!empty($_POST['level'])){
        $level = $_POST['level'];
    }
    if(!empty($_POST['contact'])){
        $contact = $_POST['contact'];
    }
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    }
    if(!empty($_POST['parent_name'])){
        $parentName = $_POST['parent_name'];
    }
    if(!empty($_POST['parent_contact'])){
        $parentContact = $_POST['parent_contact'];
    }
    if(!empty($_POST['disability'])){
        $disability = $_POST['disability'];
    }
    else{
        $disability = 'None';
    }
    if($_POST['is_under_scholarship'] == 'Yes' && $_POST['scholarship'] != 'others'){
        $scholarshipSpecify = $_POST['scholarship'];
    }
    else if($_POST['is_under_scholarship'] == 'No'){
        $scholarshipSpecify = 'None';
    }
    else{
        $scholarshipSpecify = $_POST['specified_scholarship'];
    }
    if(!empty($_POST['room_number'])){
        $roomNumber = $_POST['room_number'];
    }
    
    $isSuccess = $crud->insertStudentInfo($firstName,$lastName,$studentId,$category,$level,$programme,$contact,$email,$parentName,$parentContact,$disability,$scholarshipSpecify,$roomNumber);

    if($isSuccess){
        include 'includes/successMessage.php';
        header('Location: viewRegisteredStudents.php');
    }
    else{
        include 'includes/errMessage.php';
    }

    
}

?>


    <main class="pt-3">
        <h2 class="text-center">Register</h2>
        <div class="d-flex justify-content-center justify-content-center">
            <form action="register.php" method="post" id="register_form" class="form py-3 px-5 rounded-3 shadow-lg bg-white needs-validation" novalidate>
                <div>
                    <label for="first_name" class="form-label">First Name</label>
                    <div>
                        <input type="text" name="first_name" id="first_name" class="form-control pe-5" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="last_name" class="form-label">Last Name</label>
                    <div>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="student_id" class="form-label">Student ID</label>
                    <div>
                        <input type="text" name="student_id" id="student_id" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="category" class="form-label">Category</label>
                    <div>
                        <select name="category" id="category" class="form-select" required>
                            <option selected disabled value="">Select Category</option>
                            <option value="undergraduate">Undergraduate</option>
                            <option value="abe">ABE</option>
                            <option value="ncce">NCCE</option>
                        </select>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="programme" class="form-label">Programme</label>
                    <div>
                        <select name="programme" type="text" class="form-select" required>
                            <option selected disabled value="">Select Programme</option>
                            <option value="B.Sc. Actuarial Science">B.Sc. Actuarial Science</option>
                            <option value="B.Sc. Quantity Surveying and Building Economics">B.Sc. Quantity Surveying and Building Economics</option>
                            <option value="B.A. Communication Studies">B.A. Communication Studies</option>
                            <option value="Association of Business Executives (ABE)">Association of Business Executives (ABE)</option>
                            <option value="National Centre for Computer Education (NCCE)">National Centre for Computer Education (NCCE)</option>
                            <option value="B.Eng Pre-Engineering">B.Eng Pre-Engineering</option>
                            <option value="Bachelor of Laws (LL.B)">Bachelor of Laws (LL.B)</option>
                            <option value="B.Sc. Physician Assistantship Studies - Medical">B.Sc. Physician Assistantship Studies - Medical</option>
                            <option value="B.Sc. Business Administration (Accounting)">B.Sc. Business Administration (Accounting)</option>
                            <option value="B.Sc. Industrial Software Engineering">B.Sc. Industrial Software Engineering</option>
                            <option value="B.Sc. Business Administration (Banking & Finance)">B.Sc. Business Administration (Banking & Finance)</option>
                            <option value="Bachelor of Commerce (Accounting with Computing)">Bachelor of Commerce (Accounting with Computing)</option>
                            <option value="B.Sc. Business Administration (Corporate & Business Development Studies)">B.Sc. Business Administration (Corporate & Business Development Studies)</option>
                            <option value="B.Sc. Business Administration (Human Resource Management)">B.Sc. Business Administration (Human Resource Management)</option>
                            <option value="B.Sc. Business Administration (Insurance with Actuarial Science)">B.Sc. Business Administration (Insurance with Actuarial Science)</option>
                            <option value="B.Sc. Business Administration (Logistics and Supply Chain Management)">B.Sc. Business Administration (Logistics and Supply Chain Management)</option>
                            <option value="B.Sc. Business Administration (Marketing)">B.Sc. Business Administration (Marketing)</option>
                            <option value="B.Sc. Construction Technology and Engineering Management">B.Sc. Construction Technology and Engineering Management</option>
                            <option value="B.Sc. Information Technology">B.Sc. Information Technology</option>
                            <option value="B.Sc. Nursing">B.Sc. Nursing</option>
                        </select>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="level" class="form-label">Level</label>
                    <div>
                        <select name="level" id="level" class="form-select" required>
                            <option selected disabled value="">Choose level</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="400">4</option>
                            <option value="400">5</option>
                            <option value="400">6</option>
                        </select>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="contact" class="form-label">Contact</label>
                    <div>
                        <input name="contact" type="number" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <div>
                        <input name="email" type="email" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="parent_name" class="form-label">Parent's name</label>
                    <div>
                        <input name="parent_name" type="text" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="parent_contact" class="form-label">Parent's Contact</label>
                    <div>
                        <input name="parent_contact" id="parent_contact" type="number" class="form-control" required>
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <label for="is_under_scholarship" class="form-label">Are you physically challenged?</label>
                    <div>
                        <input name="is_challenged" type="radio" class="" id="challenged" value="Yes" required>Yes<br>
                        <input name="is_challenged" type="radio" class="" id="not_challenged" value="No" required>No
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div class="specify_disability_container">
                    <label for="disability" class="form-label">Please Specify</label>
                    <div>
                        <input name="disability" id="disability" type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="is_under_scholarship" class="form-label">Are you under scholarship?</label>
                    <div>
                        <input name="is_under_scholarship" type="radio" class="" id="under_scholarship" value="Yes" required>Yes<br>
                        <input name="is_under_scholarship" type="radio" class="" id="not_under_scholarship" value="No" required>No
                        <div class="invalid-feedback">Wrong Input</div>
                    </div>
                </div>
                <div>
                    <div class="choose_scholarship_container">
                        <label for="scholarship" class="form-label">Scholarship</label>
                        <select name="scholarship" id="scholarship_select" class="form-select" required>
                            <option value="choose_scholarship" selected disabled>Choose Scholarship</option>
                            <option value="Church Of Pentecost">Church of Pentecost</option>
                            <option value="Pentecost University">Pentecost University</option>
                            <option value="Get Fund">GET Fund</option>
                            <option value="others">Others(Please Specify)</option>
                        </select>
                        <div class="invalid-feedback">Wrong Input</div>
                        <div class="" id="specify_scholarship_container">
                            <label for="specified_scholarship">Specify Scholarship</label>
                            <div>
                                <input type="text" name="specified_scholarship" id="specified_scholarship" class="form-control">
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
                                    echo '<button type="button" value="'.$r['room_number'].'" class="btn btn-outline-primary m-2 room-button ';
                                    if($r['current_students'] == $r['max_students']){
                                        echo 'disabled bg-secondary';
                                    }
                                    echo '">'.$r['room_number'].'</button>';
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
                    <span class="" id="room_num_display"></span>
                    <div>
                        <input type="number" name="room_number" id="room_number" class="form-control d-none">
                        <div class="invalid-feedback">Please select a room</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <input type="submit" name="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>
<?php require_once './includes/footer.php';?>
<script defer src="register_script.js"></script>