<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";
    date_default_timezone_set("Asia/Dhaka");

    include("dbcon.php");
    if(isset($_GET["bano"])) {
        $bano = $_GET["bano"];
        $_COOKIE['bano'] = $bano;
        if(isset($_POST["submit"])) {
            
            $odometer = $_POST['odometer'];
            $fuelUsed = $_POST['fuel-amnt'];
            $returnDate = new DateTime();
            
            $quary = "SELECT * FROM `vdra` WHERE bano = '".$bano."' AND returntime is null";
            $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

            if(mysqli_num_rows($result1) > 0){
                $row = $result1->fetch_assoc();
                $milageBefore = $row['milagebefore'];
                $fuelBefore = $row['fuelbefore'];
            }

            $fuelRemain = $fuelBefore -  $fuelUsed;
            $distance = $odometer - $milageBefore;
    
            $quary = "UPDATE `vdra` SET returntime = '".$returnDate->format('Y-m-d H:i:s')."', milageafter = '".$odometer."', distencecovered = '".$distance."', fuelexpenditure = '".$fuelUsed."', fuelpresent = '".$fuelRemain."' WHERE bano = '".$bano."' AND returntime is null";
            $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
    
            $quary = "UPDATE `vehicle` SET status = 'available', fuelremaining = '".$fuelRemain."', milage = '".$odometer."' WHERE bano = '".$bano."' AND status = 'unavailable'";
            $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));
    
            if($result2 && $result3) {
                $quary = "commit";
                mysqli_query($con, $quary) or die(mysqli_error($con));
                echo '<script>alert("Vehicle Returned Successful");</script>';
                header("refresh:.1; url=mt_veh_outside.php");
            }
    
            else {
                $quary = "rollback";
                mysqli_query($con, $quary) or die(mysqli_error($con));
                echo '<script>alert("Fuel Request was not successful");</script>';
            }
        }
    }

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
                <?php 
                    echo '<form action="mt_veh_return.php?bano='.$_COOKIE["bano"].'" method="post">';
                ?>
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