<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("location:user_login.php");
}
include('include/connect.php');

$user_id = $_GET['user_id'];
$sql_user = "SELECT * FROM users WHERE user_id='$user_id'";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$user_name = $row_user['user_name'];
$user_vehicleno = $row_user['user_vehicleno'];

if (isset($_POST['submit'])) {
    $slot_date = $_POST['slot_date'];
    //echo $slot_date; exit;
    $start_time = $_POST['start_time'];
    $no_of_hr = $_POST['no_of_hr'];
    //echo $slot_date;

    $exit_time = date('H:i', strtotime($start_time . '+ ' . $no_of_hr . ' hour'));
    //echo $exit_time; exit;
    $sql_check = "SELECT * FROM parking_details WHERE user_id='$user_id'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_fetch_assoc($result_check) == 0) {
        $sql = "INSERT INTO `parking_details`(`user_vehicleno`, `user_name`,`user_id`, `slot_date`, `start_time`,`no_of_hr`,`exit_time`) VALUES ('$user_vehicleno','$user_name','$user_id','$slot_date','$start_time','$no_of_hr','$exit_time')";

        $result = mysqli_query($conn, $sql);
    } else if (mysqli_fetch_assoc($result_check) == 1) {
        $sql = "UPDATE `parking_details` SET `slot_date`='$slot_date',`start_time`='$start_time',`no_of_hr`='$no_of_hr',`exit_time`='$exit_time' WHERE $user_id='$user_id'";
        $result = mysqli_query($conn, $sql);
    }
}
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
        .btn {
            border-radius: 0;
        }

        .btn-outline-primary,
        .btn-danger {
            margin-top: 25px;
            margin-bottom: 8px;
        }

        .container {
            padding-top: 20px;
        }

        body {
            background-image: url('images/wall.jpg');
            position: auto;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php include('header_user.php'); ?>
    <div class="container">
        <h3>Select slot</h3>
        <div class="row">
            <?php
            $sql_slot = "SELECT * FROM slot_master";
            $result_slot = mysqli_query($conn, $sql_slot);
            while ($data = mysqli_fetch_array($result_slot)) {
                if ($data['slot_status'] == 0) {
            ?>
                    <div class="col-lg-2">
                        <hr>
                        <a type=" button" class="btn btn-outline-primary btn-lg btn-block" href="source/confirm_slot.php?slot_id=<?php echo $data['slot_id']; ?>&&user_id=<?php echo $user_id; ?>">Slot
                            <?php echo $data['slot_id']; ?>
                        </a>
                    </div>
                    <?php } else if ($data['slot_status'] == 1) {
                    $sql_time = "SELECT * FROM parking_details";
                    $result_time = mysqli_query($conn, $sql_time);
                    $row_time = mysqli_fetch_assoc($result_time);
                    echo $row_time['start_time'];
                    echo $row_time['exit_time'];
                    echo $start_time;
                    echo $_POST['end_time'];
                    exit;
                    if (($_POST['start_time'] < $row_time['start_time'] && $_POST['exit_time'] < $row_time['start_time']) ||
                        ($_POST['start_time'] > $row_time['exit_time'] && $_POST['exit_time'] > $row_time['exit_time'])
                    ) {
                    ?> <div class="col-lg-2">
                            <hr>
                            <a type=" button" class="btn btn-outline-primary btn-lg btn-block" href="source/confirm_slot.php?slot_id=<?php echo $data['slot_id']; ?>&&user_id=<?php echo $user_id; ?>">Slot
                                <?php echo $data['slot_id']; ?>
                            </a>
                        </div>
                    <?php } else {
                    ?>
                        <div class="col-lg-2">
                            <hr>
                            <button type="button" class="btn btn-danger btn-lg btn-block" disabled>Slot
                                <?php echo $data['slot_id']; ?>
                            </button>
                        </div>
            <?php  }
                }
            } ?>
            <br>
            <p>
                <small>
                    <img src="images/icon/red_block.png" height="20px" width="20px" style="border:1px solid;">
                    slot already booked<br>
                    <img src=" images/icon/white_block.png" height="20px" width="20px" style="border:1px solid;">
                    slot available
                </small>
            </p>
        </div>
    </div>
</body>

</html>