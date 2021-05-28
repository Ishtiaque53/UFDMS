<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    if(isset($_POST["sendEcht"])){

        $class=$_POST['list'];

        foreach ($class as $value => $k) {

            if($k == 'approved' || $k == 'not approved')
            {
                include("dbcon.php");
                $quary="UPDATE `vehicle_req` SET status='".$k."' WHERE serial='".$value."'";
                $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));
                if($k == 'approved'){
                    $quary="SELECT * from vehicle_req WHERE serial='".$value."'";
                    $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
                    if (mysqli_num_rows($result2) > 0) {
                        $row = mysqli_fetch_assoc($result2); 
                        $bano = $row["bano"];
                        $milage = $row["milage"];
                        $kpl = $row["kpl"];
                        $fueldate = $row["fueldate"];
                        $fuelIssue = $row["fuelissue"];
                        $fuelRemaining = $row["fuelremaining"];
                        $classification = $row["classification"];
    
                        $quary = "INSERT INTO vehicle (bano, milage, kpl, fueldate, fuelissue, fuelremaining, classification) VALUES ('".$bano."', '".$milage."', '".$kpl."', '".$fueldate."', '".$fuelIssue."', '".$fuelRemaining."', '".$classification."')";
                        $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));

                        $quary = "INSERT INTO mtcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Add Vehicle', 'Vehicle: ".$bano." approved', '0', 'mt_veh_list.php')";
                        $result4 = mysqli_query($con, $quary) or die(mysqli_error($con));
                    }
                }
                else{
                    $quary = "SELECT * FROM `vehicle_req` WHERE serial='".$value."'";
                    $result5 = mysqli_query($con, $quary) or die(mysqli_error($con));
                    if(mysqli_num_rows($result5) > 0){
                        $row = $result5->fetch_assoc();
                        $bano1 = $row['bano'];
                    }
                    $quary = "INSERT INTO mtcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Add Vehicle', 'Vehicle: ".$bano1." not approved', '0', 'mt_veh_list.php')";
                    $result6 = mysqli_query($con, $quary) or die(mysqli_error($con));
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
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="css/qm_new_veh.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Add Vehicle</p>
                <div class = "search-box">
                    <form action="qm_new_veh.php" method="post">
                        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
                        <input type="submit" name="search-button" value="Search">
                        <button onclick="window.location.href='qm_new_veh.php';">Reset</button>
                    </form>
                </div>
                <form action="qm_new_veh.php" method="post">
                
                    <?php 
                        include("dbcon.php");
                        if(isset($_POST["search-button"])) {
        
                            $bano = $_POST["search"];
                            $quary = "SELECT * FROM `vehicle_req` WHERE bano = '".$bano."' AND status = 'requested'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        else {
                            $quary = "SELECT * FROM `vehicle_req` where status = 'requested'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }


                        echo '<table> 
                            <tr> 
                                <th> BA NO </th> 
                                <th> Milage </th> 
                                <th> KPL </th> 
                                <th> Last Fuel Issue Date </th> 
                                <th> Last Fuel Issued </th> 
                                <th> Fuel Remaining </th>
                                <th> Classification </th>
                                <th> Status </th>
                            </tr>';

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["serial"];
                                $field1name = $row["bano"];
                                $field2name = $row["milage"];
                                $field3name = $row["kpl"];
                                $field4name = $row["fueldate"];
                                $field5name = $row["fuelissue"];
                                $field6name = $row["fuelremaining"];
                                $field7name = $row["classification"];
                                

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
                            echo '<script>alert("No Vehicle to Add");</script>';
                            header("refresh:.1; url=qm_home.php");
                        } 
                    ?>                   
                    <input type="submit" name ="sendEcht" value="Done">
                </form>
            </div>
        </div>
        

    </section>
</body>
</html>