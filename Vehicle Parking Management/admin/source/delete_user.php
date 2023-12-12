<?php
include('../../include/connect.php');
$user_id=$_GET['user_id'];
$sql="DELETE FROM `users` WHERE user_id='$user_id'";
$result=mysqli_query($conn,$sql);
//echo $sql;exit;
header('location:../manage_users.php');
if($result==true){
	echo "data deleted";
}
?>