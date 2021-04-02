<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";

    include("dbcon.php");
    if(isset($_POST["submit"])) {
        
        $soinikno = $_POST['soinikNo'];
        $rank = $_POST['rank'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password = crypt($password, 'rl');

        
        $quary = "Select status from `user_req` WHERE appt = 'MT' AND status = 'requested'";
        $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
        
        if (mysqli_num_rows($result2) > 0) {
            $quary = "Update `user_req` Set status = 'not approved' WHERE appt = 'MT' AND status = 'requested'";
            $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));
        }    
        
        $quary = "INSERT INTO user_req (personalnum, rank, username, password, appt, status) VALUES ('".$soinikno."', '".$rank."', '".$name."', '".$password."', 'MT', 'requested')";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result1 && $result2) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("MT NCO Change Requested");</script>';
            header("refresh:.1; url=mt_home.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("MT NCO Change could not be requested");</script>';
        }

     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT NCO Change</title>
    <link rel="stylesheet" href="css/mt_change.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">MT NCO Change</p>
                <form action="mt_change.php" method="post">
                    <label for="baNo">Soinik No:</label>
                    <input type="text" id="soinikNo" name="soinikNo" placeholder="@example- SN-1111111" required>
                    <label for="rank">Rank:</label>
                    <input type="text" id="rank" name="rank" placeholder="@example- Sgt/Lcpl/Cpl" required>
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