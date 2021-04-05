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
    <title>Change Password</title>
    <link rel="stylesheet" href="css/qm_changepassword.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Change Password</p>
                <ul class="options">
                    <li class="qm-passchng"><a href="qm_qm_password.php">QM</a></li>
                    <li class="mt-passchng"><a href="qm_mt_password.php">MT NCO</a></li>
                    <li class="pol-passchange"><a href="qm_pol_password.php">POL NCO</a></li>
                </ul>
            </div>
        </div>

    </section>

</body>
</html>