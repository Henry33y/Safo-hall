<?php
    require_once 'includes/session.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';
    if(!isset($_GET['id'])){
        include 'includes/errMessage.php';
    }
    else{
        $id = $_GET['id'];
        $result = $crud->deleteStudentRecord($id);
        if($result){
            echo "<script>window.location.href='viewRegisteredStudents.php'</script>";
        }
        else{
            include 'includes/errMessage.php';
        }
    }
?>;