<?php include('include/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        body {
            background-image: url("images/bg4.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .card {
            padding: 30px;
    background-color: rgba(187, 200, 199, 0.919);
    border: 1px solid #ddd;
    border-radius: 5px;
            width: 500px;
            margin: 150px auto;

            position: absolute;
            margin: 30px;
            top: 4%;
            padding-bottom:60px
        }

        .form-control,
        .btn {
            border-radius: 0px !important;
        }

        .form-control {
            border-left: 0px !important;
            border-right: 0px !important;
            border-top: 0px !important;
            outline: none;
        }

        input:focus,
        input.form-control:focus {
            outline: none !important;
            outline-width: 0 !important;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }

        .form-control:focus {
            border-color: inherit;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <b>REGISTER</b>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="source/user_register.php" method="post" enctype="multipart/form-data">
                                <input class="form-control" type="text" placeholder="Name" name="user_name" required><br>
                                
                                <input class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9@._%+-]/g, '').replace(/(\..*)\./g, '$1');"
                                    type="text" placeholder="E-mail" name="user_email" 
                                    required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>


                                <input class="form-control" oninput="this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                                        type="text" placeholder="Contact Number" name="user_contactno" 
                                       maxlength="10" minlength="10"required pattern="[0-9]{10}"><br>
                                
                                
                                       <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" value="male">Male
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" value="female">Female
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" value="other">Other
                                    </div>
                                </div>
                                <input class="form-control" type="text" name="user_address" placeholder="Address" required><br>
                                <input class="form-control" type="text" name="user_vehicleno" placeholder="Vehicle No." required><br>
                                <input class="form-control" type="password" name="user_password" placeholder="Password" required><br>
                                
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button><br><br>
                                <p>Already Registered? <a href="user_login.php">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
   
</body>

</html>
<?php include('footer.php'); ?>