<?php
include('../include/connect.php');
$user_id=$_GET['user_id'];
$sql1="SELECT * FROM `users` WHERE user_id='$user_id'";
//echo $sql;exit;
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update_user</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>
    .card {
        border-radius: 0px;
        padding-bottom: 5px;
    }

    .form-control,
    .btn {
        border-radius: 0px;
        border-left: 0px;
        border-right: 0px;
        border-top: 0px;
    }

    .form-control:focus {
        border-color: inherit;
        box-shadow: none;
    }

    .container-fluid {
        padding-top: 20px;
    }
    </style>
</head>

<body>
    <?php include('header.php');?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>UPDATE DETAILS</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="source/user_update.php?user_id=<?php echo $user_id?>" method="post">
                                <small><b>User Name</b></small>
                                <input class="form-control" type="text" value="<?php echo $row1['user_name'];?>"
                                    name="user_name" required><br>
                                <small><b>User E-mail</b></small>
                                <input class="form-control" type="text" value="<?php echo $row1['user_email'];?>"
                                    name="user_email" required><br>
                                <small><b>User Contact</b></small>
                                <input class="form-control" type="number" value="<?php echo $row1['user_contactno'];?>"
                                    name="user_contactno" required><br>
                                <small><b>User Gender</b></small>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="male"
                                            <?php if($row1['user_gender'] == "male"){ echo "checked";}?>
                                            name="user_gender" value="male">Male
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" value="male"
                                            <?php if($row1['user_gender'] == "female"){ echo "checked";}?>value="female">Female
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="male"
                                            <?php if($row1['user_gender'] == "other"){ echo "checked";}?>name="user_gender"
                                            value="other">Other
                                    </div>
                                </div>
                                <small><b>User Address</b></small>
                                <input class="form-control" type="text" name="user_address"
                                    value="<?php echo $row1['user_address'];?>" required><br>
                                <small><b>User Vehicle No.</b></small>
                                <input class="form-control" type="text" name="user_vehicleno"
                                    value="<?php echo $row1['user_vehicleno'];?>" required><br>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
</body>

</html>