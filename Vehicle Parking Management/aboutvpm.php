<!-- aboutvpm.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About VPM</title>
    <script>
        function toggleMenu() {
            document.querySelector('nav').classList.toggle('show');
        }
    </script>

<style>
    body{
    margin: 0;
    padding: 0;
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('images/img1.png');
    }
    body {
    font-family: 'Arial', sans-serif;
    }



    /* Hamburger menu styles */
.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    margin-right: 15px;
}

.hamburger div {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 5px 0;
    transition: 0.4s;
}

/* Add more styles as needed */

/* Media query for smaller screens */
@media screen and (max-width: 768px) {
    nav {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px; /* Adjust as needed based on your header height */
        left: 0;
        width: 100%;
        background-color: #333;
        text-align: center;
    }

    nav.show {
        display: flex;
    }

    .hamburger {
        display: flex;
        order: 2;
    }
}
/* ... (existing styles remain the same) */

</style>
</head>
<body>
    <header style="background-color: #333; display: flex; justify-content:space-between; align-items:center; top: 0;position: fixed; width: 100%;">
        <div class="logo" style="padding:10px;">
            <a href="index.php" style="color:#fff; text-decoration: none;"><h1>VPM</h1></a>
        </div>
        <nav style="color: #fff; text-decoration: none; margin-left: 10px; padding:20px;">
            <a href="index.php" style="color: #fff; text-decoration: none; margin-left: 10px; padding:10px;">Home</a>
            <a href="aboutvpm.php" style="color: #fff; text-decoration: none; margin-left: 10px; padding:10px;">About</a>
            <!-- Add more links as needed -->
        </nav>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>


<div class="container" style="background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: center;">
    <div class="row">
        <div class="col-md-12" style="padding:20px;">
            <h2>VPM - Online Parking Reservation</h2>
            <p>Welcome to the Vehicle Parking Management (VPM) system, a web-based application designed to simplify and automate the parking slot reservation process for your vehicle within parking facilities. Our goal is to provide an efficient and user-friendly platform for both vehicle owners and parking administrators.</p>
            <!-- Add more content as needed -->
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
