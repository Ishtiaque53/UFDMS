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
                    <li class="fuel-req"><a href="qm_fuel_req.php">Fuel Request</a></li>
                    <li class="alloc-fuel"><a href="qm_fuel_alloc.php">Allocate Fuel</a></li>
                    <li class="vdra"><a href="qm_vdra.php">VDRA</a></li>
                    <li class="new-veh-apprv"><a href="qm_new_veh.php">New Vehicle Approval</a></li>
                    <li class="veh-apprv"><a href="qm_veh_appv.php">Vehicle Approval</a></li>
                    <li class="veh-detail"><a href="qm_veh_list.php">Vehicle Details</a></li>
                    <li class="nco-req"><a href="qm_ncorequest.php">NCO Request</a></li>
                    <li class="chng-pass"><a href="qm_changepassword.php">Change Password</a></li>
                    <li class="appt-det"><a href="qm_appt_det.php">Appointment Details</a></li>
                </ul>
            </div>
        </div>

    </section>

</body>
</html>