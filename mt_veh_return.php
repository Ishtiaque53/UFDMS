<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";

    // include("dbcon.php");
    // if(isset($_POST["submit"])) {
        
    //     $bano = $_POST['bano'];
    //     $fuelAmount = $_POST['fuel-amnt'];
    //     $reqDate = date("Y-m-d");
        

    //     $quary = "UPDATE `fuel_req` SET status = 'not approved' WHERE bano = '".$bano."' AND status = 'requested'";
    //     $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

    //     $quary = "INSERT INTO fuel_req (bano, fueldate, fuelissue, status) VALUES ('".$bano."', '".$reqDate."', '".$fuelAmount."', 'requested')";
    //     $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

    //     if($result1 && $result2) {
    //         $quary = "commit";
    //         mysqli_query($con, $quary) or die(mysqli_error($con));
    //         echo '<script>alert("Fuel Request Successful");</script>';
    //         header("refresh:.1; url=mt_veh_return.php");
    //     }

    //     else {
    //         $quary = "rollback";
    //         mysqli_query($con, $quary) or die(mysqli_error($con));
    //         echo '<script>alert("Fuel Request was not successful");</script>';
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Return</title>
    <link rel="stylesheet" href="css/mt_veh_return.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Return Vehicle</p>
                <form action="mt_veh_return.php" method="post">
                    <label for="odometer">Odometer Reading:</label>
                    <input type="text" id="odometer" name="odometer"  required><br>
                    <label for="fuel-amnt">Fuel Used:</label>
                    <input type="text" id="fuel-amnt" name="fuel-amnt" required>
                    <input type="submit" class="login-submit" name="submit" value="Submit">
                </form>
            </div>
        </div>

    </section>

</body>
</html>