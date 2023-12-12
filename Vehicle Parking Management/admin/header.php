<head>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .btn {
        border-radius: 0px;
    }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="admin_dashboard.php" class="navbar-brand">VPM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-link">
                <a href="manage_slots.php" class="btn btn-primary">Manage Slots</a>
            </li>
            <li class="nav-link">
                <a href="manage_users.php" class="btn btn-primary">Manage User</a>
            </li>
            <li class="nav-link">
                <a class="btn btn-dark" href="source/admin_logout.php">
                    Logout<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>