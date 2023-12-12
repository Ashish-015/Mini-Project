<?php
include('../include/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
            background-image: url('../images/img4.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 8px !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 8px 8px 0 0 !important;
        }

        .card-body {
            padding: 30px;
        }

        .input-container {
            display: flex;
            margin-bottom: 20px;
        }

        .icon {
            border: 1px solid #007bff;
            padding: 10px;
            min-width: 50px;
            text-align: center;
            border-radius: 8px 0 0 8px;
            background-color: #007bff;
            color: #fff;
        }

        .form-control {
            border-radius: 0 8px 8px 0 !important;
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn {
            border-radius: 8px !important;
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn:hover {
            background-color: #218838;
        }

        p {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }

        a {
            color: #007bff;
        }
    </style>
</head>

<body style="background-image: url('images/img1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;">
    <?php
include('header2.php');
?>
    <div class="container">
        <hr>
        <div class="center">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Admin Login</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="source/login_admin.php" method="post">
                                    <div class="input-container">
                                        <i class="fa fa-envelope icon"></i>
                                        <input type="text" class="form-control" name="admin_email"
                                            placeholder="Enter Email ID" required></div>
                                    <br>
                                    <div class="input-container">
                                        <i class="fa fa-key icon"></i>
                                        <input type="password" class="form-control" name="admin_password"
                                            placeholder="Enter Password" required></div>
                                    <br>
                                    <button type="submit" class="btn btn-success btn-lg btn-block"
                                        name="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
</body>

</html>