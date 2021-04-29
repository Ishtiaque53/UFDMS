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
    <title>MT NCO Home</title>
    <link rel="stylesheet" href="css/mt_home.css">
</head>
<body>
    <?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">menu</p>
                <ul class="options">
                    <li class="mt-chng"><a href="mt_change.php">MT NCO Change</a></li>
                    <li class="req-veh"><a href="mt_veh_req.php">Request Vehicle</a></li>
                    <li class="vdra"><a href="#">VDRA</a></li>
                    <li class="veh-detail"><a href="mt_veh_list.php">Vehicle Details</a></li>
                    <li class="add-veh"><a href="mt_add_veh.php">Add Vehicle</a></li>
                    <li class="veh-ret"><a href="mt_veh_outside.php">Vehicle Outside</a></li>
                    <li class="chng-pass"><a href="mt_password.php">Change Password</a></li>
                </ul>
            </div>
        </div>

    </section>
</body>
</html>