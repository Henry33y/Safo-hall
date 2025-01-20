<?php
function displayErrorToast($message) {
    echo "
    <div class='toast-container position-fixed top-0 end-0 p-3' style='z-index: 1055;'>
        <div class='toast align-items-center text-bg-danger border-0 show' role='alert' aria-live='assertive' aria-atomic='true'>
            <div class='d-flex'>
                <div class='toast-body'>
                    $message
                </div>
                <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
        </div>
    </div>
    <script>
        // Automatically hide the toast after 5 seconds
        setTimeout(() => {
            const toastElement = document.querySelector('.toast');
            if (toastElement) {
                const bootstrapToast = bootstrap.Toast.getInstance(toastElement) || new bootstrap.Toast(toastElement);
                bootstrapToast.hide();
            }
        }, 5000);
    </script>
    ";
}
?>