+<?php
include('../../include/connect.php');
if(isset($_POST['submit'])){
$admin_email=$_POST['admin_email'];
$admin_password=$_POST['admin_password'];

$sql="SELECT * FROM admin where admin_email='$admin_email' and admin_password ='$admin_password'";
//echo $sql;
//exit;
$result=mysqli_query($conn,$sql);

if($data=mysqli_num_rows($result) == 1){
    $row=mysqli_fetch_assoc($result);
    $_SESSION['admin_id']=$row['admin_id'];
    $_SESSION['admin_email']==$row['admin_email'];
    $_SESSION['admin_password']==$row['admin_password'];
    $status=1;
    header("location:../admin_dashboard.php");
    //exit;
}
else{
    ?>
<div class="alert alert-warning" role="alert">
    A simple warning alert—check it out!
</div>
<?php
    header('location:../admin_login.php');
}
}
?>