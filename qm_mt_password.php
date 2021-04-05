<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    include("dbcon.php");
    if(isset($_POST["submit"])) {
        
        $password = $_POST['password'];
        $password = crypt($password, 'rl');

        $quary = "UPDATE `user` SET password = '".$password."' WHERE todate is null AND appt = 'MT'";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result1) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("MT NCO Password Change Successful");</script>';
            header("refresh:.1; url=qm_changepassword.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("MT NCO Password Change was not successful");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT NCO Password Change</title>
    <link rel="stylesheet" href="css/qm_mt_password.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">New Password</p>
                <form action="qm_mt_password.php" method="post">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="re-password">Retype Password:</label>
                    <input type="password" id="re-password" name="re-password" required>
                    <input type="submit" class="login-submit" name="submit" value="Submit">
                </form>
            </div>
        </div>

    </section>

    <script>
        var password = document.getElementById("password"), confirm_password = document.getElementById("re-password");

        function validatePassword(){
        if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } 
            else {
                confirm_password.setCustomValidity('');
        }
        }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;

    </script>

</body>
</html>