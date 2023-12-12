<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("location:../user_login.php");
}

include('../include/connect.php');

$user_id = $_GET['user_id'];
$slot_id = $_GET['slot_id'];

$sql = "SELECT * FROM parking_details WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$start_time = $row['start_time'];
$slot_date = $row['slot_date'];

$booking_code = $user_id . $slot_id . $slot_date . $start_time;
//."-". rand(10*45, 100*98)

$sql3 = "UPDATE `slot_master` SET `slot_status`=1 WHERE slot_id=$slot_id";


$result3 = mysqli_query($conn, $sql3);

// $filename = $user_id . $slot_id;
// $path = '../uploads/qr_codes/';
// $file = $path . $filename . ".png";

// $file2 = $filename . ".png";

$qr = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$booking_code&choe=UTF-8";


//QRcode::png($booking_code, $file, $ecc, $pixel_Size, $frame_Size);
//echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$booking_code.'&choe=UTF-8' />";


$sql2 = "UPDATE `parking_details` SET `slot_id`='$slot_id',`booking_code`='$booking_code', `qr_code`='$qr' WHERE user_id=$user_id";
$result2 = mysqli_query($conn, $sql2);
//echo $qr;
//echo $sql2;
$sql3 = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);


//echo "<center><img src='".$file."'></center>"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmed Ticket</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .fa {
            color: black;
            padding: 10px;
        }

        .container {
            padding-top: 20px;
        }

        .card {
            border-radius: 0px;
        }

        .btn {
            border-radius: 0px;
        }

        h5 {
            font-size: 20px;
            padding: 10px;
        }

        small {
            font-size: 15px;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="user_dashboard.php" class="navbar-brand">VPM</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
                <a href="../user_dashboard.php" class="nav-link">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a href="../source/logout_user.php" class="btn btn-primary">
                    LOGOUT<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>


<body>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Sucessfully confirmed!
        </div>


        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <div class="card" style="width: 22rem;">
                        <h5>ONLINE PARKING BOOKING</h5>
                        <small>**Address** <?php echo date("d-m-Y") . ' ' . date("h:iA"); ?></small>
                        <hr>
                        <img src="<?php echo $qr ?>" class="card-img-top" style="width:200px;height:200px; margin-left: auto;margin-right: auto;" alt="booking qr">
                        <!-- <?php echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$booking_code.'&choe=UTF-8' />";
 ?> -->
                        <div class="card" style="padding:2px;border: 2px solid black;border-left:none;border-right:0px;border-radius:0px;">
                            TICKET NUMBER :
                            <?PHP echo $booking_code ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <h4 class="card-text"><?php echo strtoupper($row3['user_name']); ?></h4>
                            <li class="list-group-item">SLOT NUMBER : <?php echo $slot_id; ?></li>
                            <li class="list-group-item">DATE : <?php echo $row['slot_date']; ?></li>
                            <li class="list-group-item">TIME : <?php echo $row['start_time']; ?></li>
                            <li class="list-group-item">VEHICLE NUMBER : <?php echo $row['user_vehicleno']; ?></li>
                            <li class="list-group-item">TOTAL PRICE : ₹<?php echo $row['no_of_hr'] * 10; ?></li>

                            <li class="list-group-item"><b>PLEASE SHOW THIS QR CODE DURING ENTRY & EXIT</b></li>
                        </ul>
                    </div>
                    <div>
                        <a href="../ticket.php?slot_id=<?php echo $slot_id; ?>&&user_id=<?php echo $user_id; ?>"><i class="fa fa-download fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>

                </center>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    </div>


</body>

</html>