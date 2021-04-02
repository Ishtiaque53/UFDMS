<?php
    $authAppt="POL";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"pol_home.php\"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POL NCO Home</title>
    <link rel="stylesheet" href="css/pol_home.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">menu</p>
                <ul class="options">
                    <li class="pol-chng"><a href="pol_change.php">POL NCO Change</a></li>
                    <li class="req-fuel"><a href="#">Request Fuel</a></li>
                    <li class="vdra"><a href="#">VDRA</a></li>
                    <li class="veh-detail"><a href="#">Vehicle Details</a></li>
                   <li class="apprvd-req"><a href="#">Approved Request</a></li>
                </ul>
            </div>
        </div>

    </section>
</body>
</html>