<?php
include('../../include/connect.php');

$user_id=$_GET['user_id'];
if (isset($_POST['submit'])){
    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_contactno=$_POST['user_contactno'];
    $user_gender=$_POST['user_gender'];
    $user_address=$_POST['user_address'];
    $user_vehicleno=$_POST['user_vehicleno'];

$sql="UPDATE `users` SET `user_name`='$user_name',`user_email`='$user_email',`user_contactno`='$user_contactno',`user_gender`='$user_gender',`user_address`='$user_address',`user_vehicleno`='$user_vehicleno' WHERE `user_id`='$user_id'";
//echo $sql;exit;
$result=mysqli_query($conn,$sql);
}
if(($result) == 1){
    $status=1;
    header("location:../manage_users.php?status=".$status);
    ?>
<div class="alert alert-success" role="alert">Sucessfully Updated!</div>
<?php
    }
    else {
        $status=2;
        header("location:../manage_users.php?status=".$status); ?>
<?php
    }
?>
?>