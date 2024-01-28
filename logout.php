<?php 
    include_once 'includes/session.php';
?>

<?php 
    session_destroy();
    echo "<script>window.location.href='login.php'</script>";
?>