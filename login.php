<?php
    $title = 'Admin Login | Safo Hall Pentvars';

    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/db_conn.php';
    require_once 'includes/errorToast.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];
        $new_password = md5($password.$username);
        
        $result = $user->getUser($username,$new_password);

        if(!$result){
            displayErrorToast('Invalid Username or Password');
        }else{
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $result['id'];
            echo "<script>window.location.href='viewRegisteredStudents'</script>";
        }
    }

?>


<div class="d-flex justify-content-center mb-4">
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" class="form needs-validation shadow p-3 mt-4 bg-white rounded-2" id="login_form" novalidate method="POST">
        <h1 class="text-center">Admin Login</h1>
        <p class="text-center text-danger">For Administrators only!</p>
        <div>
            <div>
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username'];?>">
                <div class="invalid-feedback">Username cannot be empty</div>
            </div>
            <div class="mb-4">
                <label for="" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" 
                           class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback">Password cannot be empty</div>
                </div>
            </div>
            <input class="btn btn-primary w-100 border-0" type="submit" name="submit">
        </div>
        <!--<a href="">Forgot Password</a>-->
    </form>
</div>

<script defer>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#login_form');
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        // Bootstrap Form Validation
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated'); // Add validation styling
        });

        // Toggle Password Visibility
        togglePasswordButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const passwordInput = button.previousElementSibling;
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Update button icon
                button.innerHTML = 
                    type === 'password' 
                    ? '<i class="bi bi-eye"></i>' 
                    : '<i class="bi bi-eye-slash"></i>';
            });
        });
    });
</script>
<?php require_once 'includes/footer.php' ?>