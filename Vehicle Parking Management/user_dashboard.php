<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("location:user_login.php");
}
include('include/connect.php');
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
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
        body {
            background-image: url('images/img1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            padding-top: 20px;
        }

        .jumbotron {
            background-color: rgba(153,182,193,255)
            padding: 10px;
            border-radius: 15px;
        }

        .jumbotron h1 {
            color: #007bff;
        }

        .jumbotron p {
            color: #343a40;
        }

        .btn {
            border-radius: 8px;
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>
</head>

<body>
    <?php include('header_user.php'); ?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-5">
                <?php echo "WELCOME "; ?> <b><?php echo strtoupper($row['user_name']); ?>!</b>
            </h1>
            <p class="lead">List & Rent your Space for Parking.</p>
            <center>
                <hr class="my-4">
                <!--<a class="btn btn-info btn-lg" href="search.php" role="button">Search</a>-->
                <a class="btn btn-primary btn-lg" href="check_booking.php?user_id=<?php echo $row['user_id'] ?>" role="button">Book Your Slot</a>
                <!--<a class="btn btn-danger btn-lg" href="source/selected_datetime.php?user_id=<?php echo $row['user_id'] ?>" role="button">Cancel</a>-->
            </center>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>
