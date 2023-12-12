<?php include('include/connect.php'); ?>
<?php include('header.php'); ?>
<htmml lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Parking Management</title>
    
    <link rel="stylesheet" href="css/index.css">
    <style>
        body {
            background-position: center;
            width: 100%;
            height: auto;
            background-repeat: no-repeat;
            background-size: cover;
            background-image:url(images/img1.png);
            /* Add other styles as needed */
        }

        .container {
            text-align: center;
        }

        /* ... (rest of your styles) */
    </style>
</head>
<body>
<div class="container" style="background-color: #fff; 
    padding: 30px;
    margin: 30px auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: center;">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="heading">
                    <img src="images/icon.png" height="200px" width="200px" alt="Parking Icon" >
                    <h1>Vehicle Parking Management</h1>
                    <h4>Book Your Parking Slot in Advance</h4>
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <a href="register.php" class="list-group-item">Register</a>
                        <a href="user_login.php" class="list-group-item">Login</a>
                    </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>


    <?php include('footer.php'); ?>
</body>

</html>
