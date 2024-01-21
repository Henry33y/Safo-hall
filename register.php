<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script defer src="register_script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body class="min-vh-100 position-relative">
    <div class="dark-btn position-absolute rounded-pill end-0 mt-3 me-3 position-relative d-flex align-items-center"></div>
    <main class="pt-4">
        <h2 class="text-center">Register</h2>
        <div class="d-flex justify-content-center justify-content-center">
            <form action="" method="post" id="register_form" class="form py-3 px-5 rounded-3 shadow-lg bg-white">
                <div>
                    <label for="" class="form-label">First Name</label>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Last Name</label>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Student ID</label>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Category</label>
                    <div>
                        <select name="" id="" class="form-select">
                            <option value="default">Select Category</option>
                            <option value="undergraduate">Undergraduate</option>
                            <option value="abe">ABE</option>
                            <option value="ncce">NCCE</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="programme" class="form-label">Programme</label>
                    <div>
                        <select name="programme" type="text" class="form-select">
                            <option value="default">Select Programme</option>
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
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Level</label>
                    <div>
                        <select name="level" id="" class="form-select">
                            <option value="default">Choose level</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="400">4</option>
                            <option value="400">5</option>
                            <option value="400">6</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Contact</label>
                    <div>
                        <input name="contact" type="number" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">Parent's name</label>
                    <div>
                        <input name="parent_name" type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="parent_contact" class="form-label">Parent's Contact</label>
                    <div>
                        <input name="parent_contact" id="parent_contact" type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <label for="is_under_scholarship" class="form-label">Are you under scholarship?</label>
                    <div>
                        <input name="is_under_scholarship" type="radio" class="" id="under_scholarship" value="Yes">Yes<br>
                        <input name="is_under_scholarship" type="radio" class="" id="not_under_scholarship" value="No">No
                    </div>
                </div>
                <div>
                    <div class="choose_scholarship_container">
                        <label for="scholarship" class="form-label">Scholarship</label>
                        <select name="scholarship" id="scholarship_select" class="form-select">
                            <option value="default_scholarship">Choose Scholarship</option>
                            <option value="Church Of Pentecost">Church of Pentecost</option>
                            <option value="Pentecost University">Pentecost University</option>
                            <option value="Get Fund">GET Fund</option>
                            <option value="others">Others(Please Specify)</option>
                        </select>
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
                <div id="choose_room_modal_container" class="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Choose Room</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>
    <footer class="">
        <div class="text-center fs-6">&copy;Developed by ZealCraft Innovations</div>
    </footer>
</body>
</html>