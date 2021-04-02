<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    include("dbcon.php");
    if(isset($_POST["submit"])) {
        
        $bano = $_POST['baNo'];
        $rank = $_POST['rank'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password = crypt($password, 'rl');
        $fromDate = new DateTime();

        $quary = "INSERT INTO user (personalnum, rank, username, password, fromdate, appt) VALUES ('".$bano."', '".$rank."', '".$name."', '".$password."', '".$fromDate->format('Y-m-d H:i:s')."', 'QM')";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "UPDATE `user` SET todate = '".$fromDate->format('Y-m-d H:i:s')."' WHERE username = '".$_SESSION['username']."'";
        $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result && $result2) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("QM Change Successfull");</script>';
            header("refresh:.1; url=logout.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("QM Change was not successful");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QM Change</title>
    <link rel="stylesheet" href="css/qm_change.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">QM Change</p>
                <form action="qm_change.php" method="post">
                    <label for="baNo">BA No:</label>
                    <input type="text" id="baNo" name="baNo" placeholder="@example- BA-11111" required>
                    <label for="rank">Rank:</label>
                    <input type="text" id="rank" name="rank" placeholder="@example- Lt" required>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="@example- Imrul" required>
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