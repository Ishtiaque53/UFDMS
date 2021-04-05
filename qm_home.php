<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QM Home</title>
    <link rel="stylesheet" href="css/qm_home.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">menu</p>
                <ul class="options">
                    <li class="qm-chng"><a href="qm_change.php">QM Change</a></li>
                    <li class="fuel-req"><a href="#">Fuel Request</a></li>
                    <li class="alloc-fuel"><a href="#">Allocate Fuel</a></li>
                    <li class="vdra"><a href="#">VDRA</a></li>
                    <li class="new-veh-apprv"><a href="#">New Vehicle Approval</a></li>
                    <li class="veh-apprv"><a href="#">Vehicle Approval</a></li>
                    <li class="veh-detail"><a href="#">Vehicle Details</a></li>
                    <li class="nco-req"><a href="#">NCO Request</a></li>
                    <li class="chng-pass"><a href="qm_changepassword.php">Change Password</a></li>
                    <li class="appt-det"><a href="#">Appointment Details</a></li>
                </ul>
            </div>
        </div>

    </section>

</body>
</html>