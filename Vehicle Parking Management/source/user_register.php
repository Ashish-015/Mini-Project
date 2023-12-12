<?php
include('../include/connect.php');

if (isset($_POST['submit'])) {
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_contactno = $_POST['user_contactno'];
	$user_gender = $_POST['user_gender'];
	$user_address = $_POST['user_address'];
	$user_rc = $_POST['user_rc'];
	$user_vehicleno = $_POST['user_vehicleno'];
	$user_password = md5($_POST['user_password']);

	$sql = "INSERT INTO `users`(`user_name`, `user_email`, `user_contactno`, `user_gender`, `user_address`, `user_vehicleno`, `user_password`) VALUES ('$user_name','$user_email','$user_contactno','$user_gender','$user_address','$user_vehicleno','$user_password')";
	//echo $sql; exit;
	$result = mysqli_query($conn, $sql);

	if ($result == 1) {
		$status = 1;
		header('location:../user_login.php?status=' . $status);
	} else {
		echo "try again!";
		header('location:../register.php');
	}
}
