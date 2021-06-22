<?php
    $authAppt="POL";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"pol_home.php\"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VDRA</title>
    <link rel="stylesheet" href="css/qm_vdra_gen.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                    <?php 
                        include("dbcon.php");
                        if(isset($_POST["submit"])) {
                            
                            $bano = $_POST["bano"];
                            $month = $_POST["month"];
                            $year = $_POST["yr"];
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                            $fdate = date("F", strtotime("2015-$monthPadding-01"));
                            echo "<p class='subhead'>BA-".$bano." ".$fdate." ".$year." VDRA</p>";
                            $quary = "SELECT * FROM `vdra` WHERE bano = '".$bano."' AND YEAR(dateofuse) = '".$year."' AND MONTH(dateofuse) = '".$month."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }

                        

                        if (mysqli_num_rows($result) > 0) {
                            $visit = 0;
                            $totalDist = 0;
                            $totalexpen = 0;

                            echo '<table class="vdradata"> 
                                    <tr> 
                                        <th> BA NO </th> 
                                        <th> Date of Use </th> 
                                        <th> Amenity </th> 
                                        <th> Start Location </th> 
                                        <th> Departure Time </th> 
                                        <th> Destination </th>
                                        <th> Return Time </th>
                                        <th> Usage Details </th>
                                        <th> Mileage Before </th>
                                        <th> Mileage After </th>
                                        <th> Distance Traveled </th>
                                        <th> Fuel Before </th>
                                        <th> Fuel Expenditure </th>
                                        <th> Fuel Present </th>
                                    </tr>';

                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["bano"];
                                $field2name = $row["dateofuse"];
                                $field3name = $row["amenity"];
                                $field4name = $row["startlocation"];
                                $field5name = $row["departuretime"];
                                $field6name = $row["destination"];
                                $field7name = $row["returntime"];
                                $field8name = $row["usagedetail"];
                                $field9name = $row["milagebefore"];
                                $field10name = $row["milageafter"];
                                $field11name = $row["distencecovered"];
                                $field12name = $row["fuelbefore"];
                                $field13name = $row["fuelexpenditure"];
                                $field14name = $row["fuelpresent"];
                                

                                echo '<tr> 
                                        <td>'.$field1name.'</td> 
                                        <td>'.$field2name.'</td> 
                                        <td>'.$field3name.'</td> 
                                        <td>'.$field4name.'</td> 
                                        <td>'.$field5name.'</td>
                                        <td>'.$field6name.'</td> 
                                        <td>'.$field7name.'</td> 
                                        <td>'.$field8name.'</td> 
                                        <td>'.$field9name.'</td> 
                                        <td>'.$field10name.'</td> 
                                        <td>'.$field11name.'</td> 
                                        <td>'.$field12name.'</td> 
                                        <td>'.$field13name.'</td>
                                        <td>'.$field14name.'</td>  
                                    </tr>';
                                    if($visit == 0){
                                        $StartFuel = $field12name;
                                        $visit = 1;
                                    }
                                    $totalDist = $totalDist + $field11name;
                                    $totalexpen = $totalexpen + $field13name;
                                    $FuelLeft = $field14name;
                                    $LastMilage = $field10name;
                            }
                            echo '</table>';
                            $result->free();

                            echo '<table class="vdraresult"> 
                            <tr> 
                                <th> Last Milage </th> 
                                <th> Total Distance </th> 
                                <th> Total Fuel Expenditure </th> 
                                <th> Staring Fuel</th> 
                                <th> Fuel Left </th> 
                            </tr>';

                            echo '<tr> 
                                    <td>'.$LastMilage.'</td> 
                                    <td>'.$totalDist.'</td> 
                                    <td>'.$totalexpen.'</td> 
                                    <td>'.$StartFuel.'</td>
                                    <td>'.$FuelLeft.'</td>
                                </tr>';
                        } 
                        else{
                            echo "<p class='subhead'>No Data Available</p>";
                        }
                    ?>                
            </div>
        </div>

    </section>
</body>
</html>