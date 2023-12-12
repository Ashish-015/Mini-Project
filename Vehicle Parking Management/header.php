<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <!-- Include any other meta tags or stylesheets you need -->
</head>

<body>
    <header>
        <div class="logo" style="padding:10px;">
            <a href="index.php" style="color:#fff; text-decoration: none;"><h1>VPM</h1></a>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="aboutvpm.php">About</a>
            <!-- Add more links as needed -->
        </nav>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <script>
        function toggleMenu() {
            document.querySelector('nav').classList.toggle('show');
        }
    </script>
    <!-- Include any other scripts or JavaScript libraries you need -->
</body>

</html>
