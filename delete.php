<?php
    require_once 'includes/db_conn.php';
    if(!isset($_GET['id'])){
        include 'includes/errMessage.php';
    }
    else{
        $id = $_GET['id'];
        $result = $crud->deleteStudentRecord($id);
        if($result){
            header('Location: viewRegisteredStudents.php');
        }
        else{
            include 'includes/errMessage.php';
        }
    }
?>;