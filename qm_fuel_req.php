<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    include 'inc.fuelrequestupdate.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    if(isset($_POST["sendEcht"])){

        $class=$_POST['list'];

        foreach ($class as $value => $k) {

            if($k == 'approved' || $k == 'not approved')
            {
                include("dbcon.php");
                $quary="UPDATE `fuel_req` SET status='".$k."' WHERE serial='".$value."'";
                $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

                $quary = "SELECT * FROM `fuel_req` WHERE serial='".$value."'";
                $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
                if(mysqli_num_rows($result2) > 0){
                    $row = $result2->fetch_assoc();
                    $bano1 = $row['bano'];
                }
                
                
                $quary = "INSERT INTO polcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Fuel Request', 'Vehicle: ".$bano1." Request ".$k."', '0', 'pol_appr_fuel.php')";
                $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));
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
    <title>Fuel Requests</title>
    <link rel="stylesheet" href="css/qm_fuel_req.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Fuel Requests</p>
                <div class = "search-box">
                    <form action="qm_fuel_req.php" method="post">
                        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
                        <input type="submit" name="search-button" value="Search">
                        <button onclick="window.location.href='qm_fuel_req.php';">Reset</button>
                    </form>
                </div>
                <form action="qm_fuel_req.php" method="post">
                
                    <?php 
                        include("dbcon.php");
                        $curDate = date("Y-m-d");
                        if(isset($_POST["search-button"])) {
        
                            $bano = $_POST["search"];
                            $quary = "SELECT * FROM `fuel_req` WHERE bano = '".$bano."' AND fueldate ='".$curDate."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        else {
                            $quary = "SELECT * FROM `fuel_req` where fueldate ='".$curDate."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }


                        echo '<table> 
                            <tr> 
                                <th> BA NO </th> 
                                <th> Amount(Liter) </th> 
                                <th> Status </th>
                            </tr>';

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["serial"];
                                $field1name = $row["bano"];
                                $field2name = $row["fuelissue"];
                                $field3name = $row["status"];
                                if($field3name == 'requested'){
                                    echo '<tr> 
                                            <td>'.$field1name.'</td> 
                                            <td>'.$field2name.'</td> 
                                            <td><select name="list['.$id.']" id="list[]">
                                            <option value="requested">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="not approved">Not Approved</option>
                                          </select></td> 
                                        </tr>';
                                }
                                else{
                                    if($field3name == 'approved'){
                                        $field3name = 'Approved';
                                    }
                                    elseif($field3name == 'not approved'){
                                        $field3name = 'Not Approved';
                                    }
                                    elseif($field3name == 'dispensed'){
                                        $field3name = 'Dispensed';
                                    }
                                    echo '<tr> 
                                            <td>'.$field1name.'</td> 
                                            <td>'.$field2name.'</td> 
                                            <td>'.$field3name.'</td> 
                                        </tr>';
                                }
                            }
                            echo '</table>';
                            $result->free();
                        }
                        else {
                            echo '<script>alert("No fuel requests");</script>';
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