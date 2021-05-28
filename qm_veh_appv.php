<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    include 'inc.requestupdate.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    if(isset($_POST["sendEcht"])){

        $class=$_POST['list'];

        foreach ($class as $value => $k) {

            if($k == 'approved' || $k == 'not approved')
            {
                include("dbcon.php");
                $quary="UPDATE `veh_mov_req` SET status='".$k."' WHERE serial='".$value."'";
                $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));
                if($k == 'approved'){
                    $quary="SELECT * from veh_mov_req WHERE serial='".$value."'";
                    $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
                    if (mysqli_num_rows($result2) > 0) {
                        $row = mysqli_fetch_assoc($result2); 
                        $bano = $row["bano"];
                        $startLoc = $row["startlocation"];
                        $depTime = $row["time"];
                        $depDate = $row["date"];
                        $amenity = $row["amenity"];
                        $destination = $row["destination"];
                        $usageDet = $row["usage_det"];

                        $quary="SELECT * from vehicle WHERE bano='".$bano."' AND status ='available'";
                        $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));
                        if (mysqli_num_rows($result3) > 0) {
                            $row2 = mysqli_fetch_assoc($result3);
                            $milage = $row2["milage"];
                            $fuelBefore = $row2["fuelremaining"];
                        }
                        else{
                            $quary = "UPDATE `veh_mov_req` SET status='requested' WHERE serial='".$value."'";
                            mysqli_query($con, $quary) or die(mysqli_error($con));
                            echo "<script>alert('".$bano." vehicle already in use');</script>";
                            goto jump;
                        }
    
                        $quary = "INSERT INTO vdra (bano, startlocation, departuretime, dateofuse, amenity, destination, usagedetail, milagebefore, fuelbefore) VALUES ('".$bano."', '".$startLoc."', '".$depTime."', '".$depDate."', '".$amenity."', '".$destination."', '".$usageDet."', '".$milage."', '".$fuelBefore."')";
                        $result4 = mysqli_query($con, $quary) or die(mysqli_error($con));
                        if($result4){
                            $quary="UPDATE vehicle SET status='unavailable' WHERE bano='".$bano."' AND status ='available'";
                            mysqli_query($con, $quary) or die(mysqli_error($con));

                            $quary = "INSERT INTO mtcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Vehicle Move', 'Vehicle: ".$bano." approved', '0', 'mt_veh_outside.php')";
                            $result5 = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        jump:
                    }
                }
                else{
                    $quary = "SELECT * FROM `veh_mov_req` WHERE serial='".$value."'";
                    $result6 = mysqli_query($con, $quary) or die(mysqli_error($con));
                    if(mysqli_num_rows($result6) > 0){
                        $row = $result6->fetch_assoc();
                        $bano1 = $row['bano'];
                    }
                    $quary = "INSERT INTO mtcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Vehicle Move', 'Vehicle: ".$bano1." not approved', '0', 'mt_veh_outside.php')";
                    $result7 = mysqli_query($con, $quary) or die(mysqli_error($con));
                }
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
    <title>Vehicle Requests</title>
    <link rel="stylesheet" href="css/qm_veh_appv.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Vehicle Requests</p>
                <div class = "search-box">
                    <form action="qm_veh_appv.php" method="post">
                        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
                        <input type="submit" name="search-button" value="Search">
                        <button onclick="window.location.href='qm_veh_appv.php';">Reset</button>
                    </form>
                </div>
                <form action="qm_veh_appv.php" method="post">
                
                    <?php
                        $date =  date("Y-m-d");
                        include("dbcon.php");
                        if(isset($_POST["search-button"])) {
        
                            $bano = $_POST["search"];
                            $quary = "SELECT * FROM `veh_mov_req` WHERE bano = '".$bano."' AND status = 'requested' AND date = '".$date."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        else {
                            $quary = "SELECT * FROM `veh_mov_req` where status = 'requested' AND date = '".$date."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }


                        echo '<table> 
                            <tr> 
                                <th> BA NO </th> 
                                <th> Start Location </th> 
                                <th> Time </th> 
                                <th> Date </th> 
                                <th> Amenity </th> 
                                <th> Destination </th>
                                <th> Usage Details </th>
                                <th> Status </th>
                            </tr>';

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["serial"];
                                $field1name = $row["bano"];
                                $field2name = $row["startlocation"];
                                $field3name = $row["time"];
                                $field4name = $row["date"];
                                $field5name = $row["amenity"];
                                $field6name = $row["destination"];
                                $field7name = $row["usage_det"];
                                

                                echo '<tr> 
                                        <td>'.$field1name.'</td> 
                                        <td>'.$field2name.'</td> 
                                        <td>'.$field3name.'</td> 
                                        <td>'.$field4name.'</td> 
                                        <td>'.$field5name.'</td>
                                        <td>'.$field6name.'</td> 
                                        <td>'.$field7name.'</td> 
                                        <td><select name="list['.$id.']" id="list[]">
                                        <option value="requested">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="not approved">Not Approved</option>
                                      </select></td 
                                    </tr>';
                            }
                            echo '</table>';
                            $result->free();
                        }
                        else {
                            echo '<script>alert("No vehicle request today");</script>';
                            echo("<script>location.href = 'qm_home.php';</script>");
                            // header("refresh:.1; url=qm_home.php");
                        } 
                    ?>
                    <input type="submit" name ="sendEcht" value="Done">
                </form>
            </div>
        </div>
        

    </section>
</body>
</html>