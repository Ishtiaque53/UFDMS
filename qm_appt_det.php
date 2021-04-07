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
    <title>Appointment Details</title>
    <link rel="stylesheet" href="css/qm_home.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Appointment Details</p>
                <ul class="options">
                    <li class="qm-appt"><a href="qm_qm_list.php">QM</a></li>
                    <li class="mt-appt"><a href="qm_mt_list.php">MT NCO</a></li>
                    <li class="pol-appt"><a href="qm_pol_list.php">POL NCO</a></li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>