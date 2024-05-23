<?php
    $title = 'User Login';

    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/db_conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];
        $new_password = md5($password.$username);
        
        $result = $user->getUser($username,$new_password);

        if(!$result){
            echo '<div class="alert alert-danger">Username or password is incorrect! Please try again</div>';
        }else{
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $result['id'];
            echo "<script>window.location.href='viewRegisteredStudents.php'</script>";
        }
    }

?>


<div class="d-flex justify-content-center">
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" class="form needs-validation shadow p-3 mt-4 bg-white rounded-2" id="login_form" novalidate method="POST">
        <h1 class="text-center"><?php echo $title ?></h1>
        <p class="text-center text-danger">For Administrators only!</p>
        <div>
            <div>
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username'];?>">
                <div class="invalid-feedback">Username cannot be empty</div>
            </div>
            <div>
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <div class="invalid-feedback">Password cannot be empty</div>
                <input type="checkbox" class="me-2" id="showPassword"><span class="text-muted">Show Password</span>
            </div>
            <input class="btn btn-primary w-100" type="submit" name="submit">
        </div>
        <!--<a href="">Forgot Password</a>-->
    </form>
</div>

<script defer>
    const form = document.getElementById('login_form');
    const showPasswordRadio = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', (e) => {
    if (!form.checkValidity()) {
      e.preventDefault()
      e.stopPropagation()
    }

    form.classList.add('was-validated')
  }, false)

    showPasswordRadio.addEventListener('change',()=>{
        if(showPasswordRadio.checked){
            passwordInput.type = "text"
        }
        else{
            passwordInput.type = "password"

        }
    })
</script>
<?php require_once 'includes/footer.php' ?>