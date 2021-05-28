<?php
    $authAppt="POL";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"pol_home.php\"";

    include("dbcon.php");
    if(isset($_POST["submit"])) {
        
        $bano = $_POST['bano'];
        $fuelAmount = $_POST['fuel-amnt'];
        $reqDate = date("Y-m-d");
        

        $quary = "UPDATE `fuel_req` SET status = 'not approved' WHERE bano = '".$bano."' AND status = 'requested'";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "INSERT INTO fuel_req (bano, fueldate, fuelissue, status) VALUES ('".$bano."', '".$reqDate."', '".$fuelAmount."', 'requested')";
        $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "INSERT INTO qmcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Fuel Request', 'Vehicle: ".$bano." Amount: ".$fuelAmount."', '0', 'qm_fuel_req.php')";
        $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result1 && $result2) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("Fuel Request Successful");</script>';
            header("refresh:.1; url=pol_fuel_request.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("Fuel Request was not successful");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Fuel</title>
    <link rel="stylesheet" href="css/pol_fuel_request.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Request Fuel</p>
                <form action="pol_fuel_request.php" method="post">
                    <label for="bano">Vehicle BA No:</label>
                    <input type="text" id="bano" name="bano" list="bano1" autocomplete="off" required><br>
                        <datalist id="bano1">
                        <?php
                            include("dbcon.php");
                            $quary = "SELECT bano from `vehicle`";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                            $i=0;
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?=$row["bano"];?>"><?=$row["bano"];?></option>
                                <?php
                                $i++;
                            }
                            mysqli_close($con);
                        ?>
                        </datalist>
                    <label for="fuel-amnt">Fuel Amount:</label>
                    <input type="text" id="fuel-amnt" name="fuel-amnt" required>
                    <input type="submit" class="login-submit" name="submit" value="Submit">
                </form>
            </div>
        </div>

    </section>

</body>
</html>