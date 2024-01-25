<?php 
    include_once 'includes/session.php';
?>

<?php 
    session_destroy();
    header('Location: login.php');
?>