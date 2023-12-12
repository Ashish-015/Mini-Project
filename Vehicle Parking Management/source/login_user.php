<?php
session_start();
include('../include/connect.php');

if (isset($_POST['submit'])) {

    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']);

    $sql = "SELECT * FROM users where user_email='$user_email' and user_password ='$user_password'";
    //echo $sql;
    //exit;
    $result = mysqli_query($conn, $sql);

    if ($data = mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_email'] == $row['user_email'];
        $_SESSION['user_password'] == $row['user_password'];
        $status = 1;
        //echo $_SESSION['user_id'];exit;
        header("location:../user_dashboard.php?user_id=" . $_SESSION['user_id']);
        //exit;
    } else {
        header('location:../user_login.php?status=2');
    }
}