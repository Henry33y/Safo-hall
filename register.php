<?php
$title = 'Register';

require_once 'includes/session.php';
session_destroy();
require_once 'includes/header.php';
require_once 'includes/db_conn.php';
$firstName = $lastName = $studentId = $category = $level = $programme = $contact = $email = $parentName = $parentContact = $physicallyChallenged = $disability = $underScholarship = $scholarshipSpecify = $roomNumber = '';
$roomResults = $crud->getRoomDetails();
if ($_SERVER['REQUEST_METHOD']=='POST') {
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
  } else if ($_POST['is_under_scholarship'] == 'No') {
    $scholarshipSpecify = 'None';
    echo $scholarshipSpecify;
  } else {
    $scholarshipSpecify = $_POST['specified_scholarship'];
  }
  if (!empty($_POST['room_number'])) {
    $roomNumber = $_POST['room_number'];
  }

  // Store form data in the session or a temporary table to retrieve after payment
  $_SESSION['form_data'] = $_POST;

  // Redirect to the Paystack payment link
  $paymentLink = "https://paystack.com/pay/safohallpentvars"; // Replace with your Paystack link
  echo "<script>window.location.href='$paymentLink'</script>";
  exit;

}
?>
  <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="style.css" />

<body>
  <div class="wrapper">
    <form action="register.php" method="post" class="needs-validation" id="wizard" novalidate>
      <h2></h2>
      <section>
        <div class="inner">
          <div class="image-holder">
            <!-- <script type="text/javascript" style="display: none">
              //<![CDATA[
              window.__mirage2 = {
                petok: "uWTkZOPuh7Oz2hxpAYNlx3rs3gq4aG_DLqG_nl3tI9o-86400-0",
              };
              //]]>
            </script> -->
            <script type="text/javascript" src="js/mirage2.min.js"></script>
            <img data-cfsrc="assets/images/Safo1.jpg" alt style="display: none; visibility: hidden" /><noscript><img
                src="images/form-wizard-1.jpg" alt /></noscript>
          </div>
          <div class="form-content">
            <div class="form-header">
              <h3>Registration</h3>
            </div>
            <p>Please fill with your details</p>
            <div class="form-row">
              <div class="form-holder">
                <input type="text" spellcheck="false" name="first_name" id="first_name" placeholder="First Name" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
              <div class="form-holder">
                <input type="text" spellcheck="false" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-holder">
                <input type="text" spellcheck="false" name="student_id" id="student_id" placeholder="Student ID" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
              <div class="form-holder">
                <select name="category" id="category" class="form-select form-control" required>
                  <option selected disabled value="">Select Category</option>
                  <option value="undergraduate">Undergraduate</option>
                  <option value="abe">ABE</option>
                  <option value="ncce">NCCE</option>
                </select>
                <div class="invalid-feedback">Please choose an option</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-holder">
                <select name="level" id="level" class="form-select form-control" required>
                  <option selected disabled value="">Choose level</option>
                  <option value="100">100</option>
                  <option value="200">200</option>
                  <option value="300">300</option>
                  <option value="400">400</option>
                  <option value="4">4</option>
                  <option value="4">5</option>
                  <option value="6">6</option>
                </select>
                <div class="invalid-feedback">Please choose an option</div>
              </div>
              <div class="form-holder" style="align-self: flex-end; transform: translateY(4px)">
                <select name="programme" type="text" class="form-select form-control" required>
                  <option selected disabled value="">Select Programme</option>
                  <option value="B.Sc. Actuarial Science">B.Sc. Actuarial Science</option>
                  <option value="B.Sc. Quantity Surveying and Building Economics">B.Sc. Quantity Surveying and Building
                    Economics</option>
                  <option value="B.A. Communication Studies">B.A. Communication Studies</option>
                  <option value="Association of Business Executives (ABE)">Association of Business Executives (ABE)
                  </option>
                  <option value="National Centre for Computer Education (NCCE)">National Centre for Computer Education
                    (NCCE)</option>
                  <option value="B.Eng Pre-Engineering">B.Eng Pre-Engineering</option>
                  <option value="Bachelor of Laws (LL.B)">Bachelor of Laws (LL.B)</option>
                  <option value="B.Sc. Physician Assistantship Studies - Medical">B.Sc. Physician Assistantship Studies
                    - Medical</option>
                  <option value="B.Sc. Business Administration (Accounting)">B.Sc. Business Administration (Accounting)
                  </option>
                  <option value="B.Sc. Industrial Software Engineering">B.Sc. Industrial Software Engineering</option>
                  <option value="B.Sc. Business Administration (Banking & Finance)">B.Sc. Business Administration
                    (Banking & Finance)</option>
                  <option value="Bachelor of Commerce (Accounting with Computing)">Bachelor of Commerce (Accounting with
                    Computing)</option>
                  <option value="B.Sc. Business Administration (Corporate & Business Development Studies)">B.Sc.
                    Business Administration (Corporate & Business Development Studies)</option>
                  <option value="B.Sc. Business Administration (Human Resource Management)">B.Sc. Business
                    Administration (Human Resource Management)</option>
                  <option value="B.Sc. Business Administration (Insurance with Actuarial Science)">B.Sc. Business
                    Administration (Insurance with Actuarial Science)</option>
                  <option value="B.Sc. Business Administration (Logistics and Supply Chain Management)">B.Sc. Business
                    Administration (Logistics and Supply Chain Management)</option>
                  <option value="B.Sc. Business Administration (Marketing)">B.Sc. Business Administration (Marketing)
                  </option>
                  <option value="B.Sc. Construction Technology and Engineering Management">B.Sc. Construction Technology
                    and Engineering Management</option>
                  <option value="B.Sc. Information Technology">B.Sc. Information Technology</option>
                  <option value="B.Sc. Nursing">B.Sc. Nursing</option>
                </select>
                <div class="invalid-feedback">Please choose an option</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <h2></h2>
      <section>
        <div class="inner">
          <div class="image-holder">
            <img data-cfsrc="assets/images/Safo2.jpg" alt style="display: none; visibility: hidden" /><noscript><img
                src="assets/images/Safo2.jpg" alt /></noscript>
          </div>
          <div class="form-content">
            <div class="form-header">
              <h3>Registration</h3>
            </div>
            <p>Please fill with Contact Info</p>
            <div class="form-row">
              <div class="form-holder w-100">
                <input type="number" name="contact" id="contact" placeholder="Contact" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-holder">
                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
              <div class="form-holder">
                <input type="text" name="parent_name" id="parent_name" placeholder="Parent's Name" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-holder">
                <input type="text" name="parent_contact" id="parent_contact" placeholder="Parent's Contact" class="form-control" required/>
                <div class="invalid-feedback">This field cannot be empty</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <h2></h2>
      <section>
        <div class="inner">
          <div class="image-holder">
            <img data-cfsrc="assets/images/Safo3.jpg" alt style="display: none; visibility: hidden" /><noscript><img
                src="assets/images/Safo3.jpg" alt /></noscript>
          </div>
          <div class="form-content">
            <div class="form-header">
              <h3>Registration</h3>
            </div>
            <p>Please fill with additional info</p>
            <div class="form-row">
              <div class="form-holder">
                <div>
                  <label for="is_challenged" class="form-check-label">Are you physically challenged?</label>
                  <div>
                    <input name="is_challenged" type="radio" class="form-check-input me-3" id="challenged" value="Yes"
                      required>Yes<br>
                    <input name="is_challenged" type="radio" class="form-check-input me-3" id="not_challenged" value="No"
                      required>No
                    <div class="invalid-feedback">Please choose an option</div>
                  </div>
                </div>
                <div class="specify_disability_container" id="specify_disability_container">
                  <label for="disability" class="form-label">Please Specify</label>
                  <div>
                    <input name="disability" id="disability" type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-holder">
                <div>
                  <label for="is_under_scholarship" class="form-check-label">Are you under scholarship?</label>
                  <div>
                    <input name="is_under_scholarship" type="radio" class="form-check-input me-3" id="under_scholarship"
                      value="Yes" required>Yes<br>
                    <input name="is_under_scholarship" type="radio" class="form-check-input me-3" id="not_under_scholarship"
                      value="No" required>No
                    <div class="invalid-feedback">Please choose an option</div>
                  </div>
                </div>
                <div>
                  <div class="choose_scholarship_container" id="choose_scholarship_container">
                    <label for="scholarship" class="form-label">Scholarship</label>
                    <select name="scholarship" id="scholarship_select" class="form-select form-control" required>
                      <option value="choose_scholarship" selected disabled>Choose Scholarship</option>
                      <option value="Church Of Pentecost">Church of Pentecost</option>
                      <option value="Pentecost University">Pentecost University</option>
                      <option value="Get Fund">GET Fund</option>
                      <option value="others">Others(Please Specify)</option>
                    </select>
                    <div class="invalid-feedback">Please choose an option</div>
                    <div class="" id="specify_scholarship_container">
                      <label for="specified_scholarship">Specify Scholarship</label>
                      <div>
                        <input type="text" name="specified_scholarship" id="specified_scholarship" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <button type="button" class="chooseRoomBtn form-control btn btn-outline-primary my-3" id="choose_room_btn"
                data-bs-toggle="modal" data-bs-target="#choose_room_modal_container">Choose Room</button>
            </div>
            <div id="choose_room_modal_container" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header d-flex flex-column text-start position-relative">
                    <h3 class="modal-title w-100">Choose Room</h3>
                    <small class="text-small w-100 mt-3">Select a room number and click on the submit button below</small>
                    <!-- <button type="button" class="btn-close position-absolute modal_close_btn"
                      data-bs-dismiss="modal"></button> -->
                  </div>
                  <div class="modal-body">
                    <?php
                    while ($r = $roomResults->fetch(PDO::FETCH_ASSOC)) {
                      echo '<button type="button" value="' . $r['room_number'] . '" class="btn btn-outline-primary m-2 room-button ';
                      if ($r['current_students'] == $r['max_students']) {
                        echo 'disabled bg-secondary';
                      }
                      echo '">' . $r['room_number'] . '</button>';
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modal-submit-btn"
                      data-bs-dismiss="modal">Submit</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <label for="room_number" class="form-label">Room Number &nbsp;</label>
              <span class="" id="room_num_display"></span>
              <div>
                <input type="number" name="room_number" id="room_number" class="form-control d-none" required>
                <div class="invalid-feedback">Please select a room</div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="checkbox-circle mt-24">
          <label>
            <input type="checkbox" checked /> Please accept
            <a href="#">terms and conditions ?</a>
            <span class="checkmark"></span>
          </label>
        </div>
  </div>
  </div>
  </section>
  </form>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>

  <script src="js/jquery.steps.js"></script>
  <script src="js/main.js"></script>


  <script>      
        $(document).ready(function(){
          var navbarHeight = $('.navbar').outerHeight();
          $('body').css('margin-top', navbarHeight + 'px');

          $("#challenged").click(function(){
            $("#specify_disability_container").show();
          });

          $("#not_challenged").click(function(){
            $("#specify_disability_container").hide();
          });

          $("#under_scholarship").click(function(){
            $("#choose_scholarship_container").show();
          });
          $("#not_under_scholarship").click(function(){
            $("#choose_scholarship_container").hide();
          });
          $("#scholarship_select").change(function(){
            $("#scholarship_select").val() == "others" ? $("#specify_scholarship_container").show() : $("#specify_scholarship_container").hide()
          })
          
          $('a[href="#finish"]').on('click', function(e) {
            e.preventDefault()
            $('#wizard').submit();
          });
          $('a[href="#finish"]').attr('name','submit')

          let selectedRoomNumber
            $('.room-button').click(function() {
            selectedRoomNumber = $(this).val();
          });

        $('.modal-submit-btn').click(function() {
          $('#room_number').val(selectedRoomNumber);
          $('#room_num_display').text(selectedRoomNumber);
          console.log($('#room_number').val());
      });



              $('#wizard').submit(function(e) {
        if (!$(this)[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        $('#wizard').addClass('was-validated');
    });
    $('#student_id').on('keyup', function() {
                let currentValue = $(this).val();
                let upperCaseValue = currentValue.toUpperCase();
                $(this).val(upperCaseValue);
                console.log('Hello');
            });    
        });
    </script>
<?php require_once 'includes/footer.php' ?>

</html>