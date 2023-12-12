<?php
include('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage_user</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>
        .container-fluid {
            padding-top: 20px;
            padding-right: 20px;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="header-line"><strong>Manage Registered Users</strong></h4>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="thead-dark">
                            <tr>
                                <th>USER ID</th>
                                <th>USER NAME</th>
                                <th>USER EMAIL</th>
                                <th>USER CONTACT NUMBER</th>
                                <th>USER ADDRESS</th>
                                <th>USER VEHICLE NUMBER</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT * from users";
                            $result = mysqli_query($conn, $sql);
                            $cnt = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr class="odd gradeX">
                                    <td class="center"><?php echo $data['user_id']; ?></td>
                                    <td class="center"><?php echo strtoupper($data['user_name']); ?></td>
                                    <td class="center"><?php echo $data['user_email']; ?></td>
                                    <td class="center"><?php echo ($data['user_contactno']); ?></td>
                                    <td class="center"><?php echo $data['user_address']; ?></td>
                                    <td class="center"><?php echo $data['user_vehicleno']; ?></td>
                                    <td><a class="btn btn-primary" href="update_user.php?user_id=<?php echo $data['user_id']; ?>">UPDATE</a>&nbsp;
                                        <a class="btn btn-danger" href="source/delete_user.php?user_id=<?php echo $data['user_id']; ?>">DELETE</a>
                                    </td>
                                <?php } ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>