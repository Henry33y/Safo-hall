<?php
    $title = 'View Record';
    require_once 'includes/session.php';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    if(!isset($_GET['id'])){
        include 'includes/errMessage.php';
    }
    else{
        $id = $_GET['id'];
        $result = $crud->getSingleStudentDetails($id);

?>
<div class="d-flex justify-content-center align-items-center flex-column">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="card-title">
                <h4>Record Details</h4>
            </div>
            <h5><?php echo $result['first_name'].' '.$result['last_name'] ?></h5>
            <p class="card-text"><b>Student ID:</b> <?php echo $result['student_id'] ?></p>
            <p class="card-text"><b>Category:</b> <?php echo $result['category'] ?></p>
            <p class="card-text"><b>Programme:</b> <?php echo $result['programme'] ?></p>
            <p class="card-text"><b>Level:</b> <?php echo $result['level'] ?></p>
            <p class="card-text"><b>Email:</b> <?php echo $result['email'] ?></p>
            <p class="card-text"><b>Contact:</b> <?php echo $result['contact'] ?></p>
            <p class="card-text"><b>Parent's Name:</b> <?php echo $result['parent_name'] ?></p>
            <p class="card-text"><b>Parent's Contact:</b> <?php echo $result['parent_contact'] ?></p>
            <p class="card-text"><b>Physical Challenges:</b> <?php echo $result['physical_challenges'] ?></p>
            <p class="card-text"><b>Scholarship:</b> <?php echo $result['scholarship'] ?></p>
            <p class="card-text"><b>Room Number:</b> <?php echo $result['room_number'] ?></p>
            <p class="card-text"><b>Reistered at:</b> <?php echo $result['registered_at'] ?></p>
        </div>
    </div>
    <br>
    <div>
        <a href="viewRegisteredStudents.php" class="btn btn-info">Back to List</a>
        <a href="edit.php?id=<?php echo $result['id'] ?>" class="btn btn-warning">Edit</a>
        <a onclick="return confirm('Are you sure you want to delete this record? This action cannot be reversed.')" href="delete.php?id=<?php echo $result['id'] ?>" class="btn btn-danger">Delete</a>
    </div>
</div>
<?php }?>

<br>
<?php require_once 'includes/footer.php'?>