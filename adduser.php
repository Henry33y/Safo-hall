<?php
    $title = 'Add Admin | Safo Hall Pentvars';

    require_once 'includes/session.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/header.php';
    require_once 'includes/db_conn.php';
    require_once 'includes/errorToast.php';
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = strtolower(trim($_POST['username']));
        $password = $_POST['password'];
        $system_password = $_POST['system_password'];

        $result = $user->insertUserWithSystemPassword($username, $password, $system_password);

        if (!$result['success']) {
            displayErrorToast($result['error']);
        } else {
            $_SESSION['username'] = $username;
            echo "<script>window.location.href='viewRegisteredStudents'</script>";
        }
    }
?>

<div class="d-flex justify-content-center">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" 
          class="form needs-validation p-3 mt-4 mb-4 bg-white rounded-2" 
          id="login_form" 
          novalidate method="POST">
        <h1 class="text-center">Add Admin</h1>
        <p class="text-center text-danger">For Administrators Only!</p>
        <div>
            <div>
                <label for="username" class="form-label">New Username</label>
                <input type="text" name="username" id="username" 
                       class="form-control" required 
                       value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['username'] : ''; ?>">
                <div class="invalid-feedback">Username cannot be empty</div>
            </div>
            <div class="mt-3">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" 
                           class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback">Password cannot be empty</div>
                </div>
            </div>
            <div class="mt-3">
                <label for="system_password" class="form-label">Enter System's Password</label>
                <div class="input-group">
                    <input type="password" name="system_password" id="system_password" 
                           class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="invalid-feedback">Password cannot be empty</div>
                </div>
            </div>
            <input class="btn btn-primary w-100 border-0 mt-4" type="submit" name="submit">
        </div>
    </form>
</div>

<script defer>
    document.addEventListener('DOMContentLoaded', () => {
        // Select all toggle-password buttons and corresponding password fields
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const passwordInput = button.previousElementSibling; // Select the related input
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle icon
                button.innerHTML = type === 'password' 
                    ? '<i class="bi bi-eye"></i>' 
                    : '<i class="bi bi-eye-slash"></i>';
            });
        });

        // Bootstrap validation
        const form = document.querySelector('#login_form');
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated'); // Add Bootstrap validation styles
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>