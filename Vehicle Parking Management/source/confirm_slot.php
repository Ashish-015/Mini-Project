<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("location:../user_login.php");
}

include('../include/connect.php');
$user_id = $_GET['user_id'];
$slot_id = $_GET['slot_id'];
include('../include/connect.php');

$sql_datetime = "SELECT * FROM parking_details WHERE user_id='$user_id'";
$result_datetime = mysqli_query($conn, $sql_datetime);
$row_datetime = mysqli_fetch_assoc($result_datetime);
$user_vehicleno = $row_datetime['user_vehicleno'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Slot</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

    <style>
        .card {
            border: 1px solid black;
            border-radius: 0px;
        }

        .btn {
            border-radius: 0px;
        }

        .container {
            margin-top: 200px;
            position: auto;

        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class=" card-header">
                        Do you want to confirm?
                    </div>
                    <div class="card-body">
                        <center>
                            <h4>
                                <p>YOU SELECTED <b></Select> SLOT <?php echo $slot_id; ?></b><br>
                                    DATE: <b><?php echo $row_datetime['slot_date']; ?></b><br>
                                    ENTRY TIME: <b><?php echo $row_datetime['start_time']; ?></b><br>
                                    EXIT TIME: <b><?php echo $row_datetime['exit_time']; ?></b><br>
                                    VEHICLE NUMBER: <b><?php echo strtoupper($user_vehicleno); ?></b>
                                </p>
                            </h4>

                        </center>
                        <form action="confirm_slot2.php?user_id=<?php echo $user_id; ?>&&slot_id=<?php echo $slot_id; ?>" method="post">
                            <center>
                                <button type="submit" name="submit" class="btn btn-success">YES</button>


                                <a href="cancel_slot.php?user_id=<?php echo $user_id; ?>&&slot_id=<?php echo $slot_id; ?>" class="btn btn-primary">NO</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

</body>

</html>