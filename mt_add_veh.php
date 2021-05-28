<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";

    include("dbcon.php");
    if(isset($_POST["request"])) {
        
        $bano = $_POST['bano'];
        $milage = $_POST['milage'];
        $kpl = $_POST['kpl'];
        $lastFuelDate = $_POST['last-fuel-date'];
        $fuelRemain = $_POST['fuel-remain'];
        $fuelIssue = $_POST['fuel-issue'];
        $classification = $_POST['classification'];
        
        $quary = "INSERT INTO vehicle_req (bano, milage, kpl, fueldate, fuelissue, fuelremaining, classification, status) VALUES ('".$bano."', '".$milage."', '".$kpl."', '".$lastFuelDate."', '".$fuelIssue."', '".$fuelRemain."', '".$classification."', 'requested')";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "INSERT INTO qmcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('New Vehicle Request', 'Vehicle: ".$bano."', '0', 'qm_new_veh.php')";
        $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result1) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("Vehicle Requested");</script>';
            header("refresh:.1; url=mt_home.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("Vehicle could not be requested");</script>';
        }

     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="css/mt_add_veh.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Add Vehicle</p>
                <form action="mt_add_veh.php" method="post">
                    <div class="left">
                        <label for="bano">BA No:</label><br>
                        <input type="text" id="bano" name="bano" required><br>
                        <label for="last-fuel-date">Last Fuel Issue Date:</label><br>
                        <input type="date" id="last-fuel-date" name="last-fuel-date" max =<?php echo date('Y-m-d');?> required><br>
                        <label for="fuel-issue">Last Fuel Issued:</label><br>
                        <input type="text" id="fuel-issue" name="fuel-issue" required><br>
                        <label for="fuel-remain">Fuel Remaining:</label><br>
                        <input type="text" id="fuel-remain" name="fuel-remain" required><br>
                    </div>
                    <div class="right">
                        <label for="milage">Milage:</label><br>
                        <input type="text" id="milage" name="milage" required><br>     
                        <label for="kpl">KPL:</label><br>
                        <input type="text" id="kpl" name="kpl" required><br>
                        <label for="classification">Classification:</label><br>
                        <input type="text" id="classification" name="classification" required><br>
                    </div>                   
                    <input type="submit" class="request" name="request" value="Request">
                                       
                </form>
            </div>
        </div>

    </section>

</body>
</html>