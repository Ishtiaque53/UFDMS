<?php
    $authAppt="MT";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"mt_home.php\"";

    include("dbcon.php");
    if(isset($_POST["request"])) {
        
        $bano = $_POST['bano'];
        $amenity = $_POST['amenity'];
        $destination = $_POST['destination'];
        $date = $_POST['move-date'];
        $startLoc = $_POST['start-loc'];
        $time = $_POST['time'];
        $usage = $_POST['use-det'];
        
        $quary = "INSERT INTO veh_mov_req (bano, startlocation, time, date, amenity, destination, usage_det, status) VALUES ('".$bano."', '".$startLoc."', '".$time."', '".$date."', '".$amenity."', '".$destination."', '".$usage."', 'requested')";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "INSERT INTO qmcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Vehicle Move Request', 'Vehicle: ".$bano." Location: ".$destination."', '0', 'qm_veh_appv.php')";
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
    <title>Vehicle Request</title>
    <link rel="stylesheet" href="css/mt_veh_req.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Vehicle Request</p>
                <form action="mt_veh_req.php" method="post">
                    <div class="left">
                        <label for="bano">BA No:</label><br>
                        <input type="text" id="bano" name="bano" list="bano1" autocomplete="off" required><br>
                        <datalist id="bano1">
                        <?php
                            include("dbcon.php");
                            $quary = "SELECT bano from `vehicle` where status = 'available'";
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
                        <label for="move-date">Date:</label><br>
                        <input type="date" id="move-date" name="move-date" min =<?php echo date('Y-m-d');?> required><br>
                        <label for="amenity">Amenity:</label><br>
                        <input type="text" id="amenity" name="amenity" required><br>
                        <label for="destination">Destination:</label><br>
                        <input type="text" id="destination" name="destination" required><br>
                    </div>
                    <div class="right">
                        <label for="start-loc">Starting Location:</label><br>
                        <input type="text" id="start-loc" name="start-loc" required><br>     
                        <label for="time">Time:</label><br>
                        <input type="time" id="time" name="time" required><br>
                        <label for="use-det">Usage Detail:</label><br>
                        <input type="text" id="use-det" name="use-det" required><br>
                    </div>                   
                    <input type="submit" class="request" name="request" value="Request">
                                       
                </form>
            </div>
        </div>

    </section>

</body>
</html>