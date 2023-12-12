<?php
include('../include/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <style>
        .container {
            padding-top: 20px;
        }
    </style>

    </head>
    <?php include('header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line"><b>ADMIN DASHBOARD</b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-user-circle-o fa-5x"></i>
                        <?php
                        $sql = "SELECT user_id from users";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($result);
                        $totaluser = mysqli_num_rows($result);
                        ?>
                        <h3><?php echo $totaluser; ?></h3>
                        <b>Total users</b>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-road fa-5x"></i>
                        <?php
                        $sql = "SELECT slot_id from slot_master";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($result);
                        $totalslots = mysqli_num_rows($result);
                        ?>
                        <h3><?php echo $totalslots; ?></h3>
                        <b>Total Slots</b>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-car fa-5x"></i>
                        <?php
                        $sql = "SELECT slot_status from slot_master WHERE slot_status=1";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($result);
                        $totalbookedslots = mysqli_num_rows($result); ?>
                        <h3><?php echo $totalbookedslots; ?></h3>
                        <b>Total Booked Slots</b>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-bars fa-5x"></i>
                        <?php
                        $sql = "SELECT slot_status from slot_master WHERE slot_status=0";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($result);
                        $totalavailableslots = mysqli_num_rows($result); ?>
                        <h3><?php echo $totalavailableslots; ?></h3>
                        <b>Total Available Slots</b>
                    </div>
                </div>

            </div>
</body>

</html>