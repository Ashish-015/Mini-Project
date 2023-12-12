<?php
session_start();
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
	header("location:../user_login.php");
}
include('../include/connect.php');
session_destroy();
session_unset(); 
header("location:../index.php");
?>