<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Outside</title>
    <link rel="stylesheet" href="css/mt_veh_outside.css">
</head>
<body>
    <?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Approved Vehicles</p>
                <ul class="options">
                <?php 
                        include("dbcon.php");
                        $quary = "SELECT * FROM `vdra` WHERE returntime is null";
                        $result = mysqli_query($con, $quary) or die(mysqli_error($con));

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["bano"];
                                $field2name = $row["destination"];
                                $field2name = explode(" ", $field2name);

                                echo '<li><a href="mt_veh_return.php?bano='.$field1name.'">'.$field1name.' '.$field2name[0].'</a></li>';    
                            }
                        } 
                    ?> 
                </ul>
            </div>
        </div>

    </section>
</body>
</html>