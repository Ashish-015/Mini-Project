<?php
//SESSION
session_start();
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
	header("location:user_login.php");
}
include('include/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

    <style>
    .container {
        padding-top: 20px;
    }

    .alert {
        border-radius: 0px;
    }
    </style>
</head>

<body>
    <?php include('header_user.php'); ?>

    <div class="container">
        <?php
    $user_id=$_GET['user_id'];

    $check="SELECT * FROM parking_details where user_id='$user_id'";
    //echo $sql;
    //exit;
    $result_check=mysqli_query($conn,$check);

    if($data=mysqli_num_rows($result_check) == 1){ 
        ?>
        <div class="alert alert-dark" role="alert">
            You already have booking!<a href="user_dashboard.php"> Go Back</a>
        </div>
        <?php
        } else {
        header("location:source/select_datetime.php?user_id=".$user_id);
        }
        ?>

</body>

</html>