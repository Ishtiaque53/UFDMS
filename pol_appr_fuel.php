<?php
    $authAppt="POL";
    include 'inc.authentication.php';
    include 'inc.fuelrequestupdate.php';
    $_COOKIE['home'] = "\"pol_home.php\"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel Approval</title>
    <link rel="stylesheet" href="css/qm_veh_list.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Fuel Approval</p>
                <div class = "search-box">
                    <form action="pol_appr_fuel.php" method="post">
                        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
                        <input type="submit" name="search-button" value="Search">
                        <button onclick="window.location.href='pol_appr_fuel.php';">Reset</button>
                    </form>
                </div>
                    <?php 
                        include("dbcon.php");
                        $curDate = date("Y-m-d");
                        if(isset($_POST["search-button"])) {
        
                            $bano = $_POST["search"];
                            $quary = "SELECT * FROM `fuel_req` WHERE bano = '".$bano."' AND fueldate = '".$curDate."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        else {
                            $quary = "SELECT * FROM `fuel_req` WHERE fueldate = '".$curDate."'";
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
                                $field1name = $row["bano"];
                                $field2name = $row["fuelissue"];
                                $field3name = $row["status"];
                                if($field3name == 'requested'){
                                    $field3name = 'Pending';
                                }
                                elseif($field3name == 'approved'){
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
                            $result->free();
                        } 
                    ?>                
            </div>
        </div>

    </section>
</body>
</html>