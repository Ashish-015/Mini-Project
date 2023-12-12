<?php
include('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage_slots</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>
    .container {
        padding-top: 20px;
        padding-right: 20px;
        padding-left: 20px;
    }
    </style>
</head>

<body>
    <?php include('header.php');?>
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h4 class="header-line"><strong>Manage Slots</strong></h4>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="thead-dark">
                            <tr>
                                <th>SLOT ID</th>
                                <th>SLOT NUMBER</th>
                                <th>SLOT STATUS</th>
                                <th>SLOT ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT * from slot_master";
									    $result=mysqli_query($conn,$sql);
									    $cnt=1;
                                        while($data=mysqli_fetch_array($result)){                                    
									    ?>
                            <tr class="odd gradeX">
                                <td class="center"><?php echo $data['slot_id'];?></td>
                                <td class="center"><?php echo $data['slot_no'];?></td>
                                <td class="center"><?php echo $data['slot_status'];?></td>
                                <td>
                                    <center>
                                        <?php
                                    if($data['slot_status']==1){?>
                                        <a class="btn btn-danger btn-block"
                                            href="update_slot.php?user_id=<?php echo $data['slot_id'];?>">INACTIVE</a>
                                        <?php }else{?>
                                        <a class="btn btn-success btn-block"
                                            href="update_slot.php?user_id=<?php echo $data['slot_id'];?>">ACTIVE</a>
                                        <?php }
                                        ?>
                                    </center>
                                </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</body>

</html>