<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details</title>
    <link rel="stylesheet" href="css/qm_veh_list.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">Vehicle Details</p>
                <div class = "search-box">
                    <form action="qm_veh_list.php" method="post">
                        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
                        <input type="submit" name="search-button" value="Search">
                        <button onclick="window.location.href='qm_veh_list.php';">Reset</button>
                    </form>
                </div>
                    <?php 
                        include("dbcon.php");
                        if(isset($_POST["search-button"])) {
        
                            $bano = $_POST["search"];
                            $quary = "SELECT * FROM `vehicle` WHERE bano = '".$bano."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        else {
                            $quary = "SELECT * FROM `vehicle`";
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
                                <th> Added On </th>
                            </tr>';

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["bano"];
                                $field2name = $row["milage"];
                                $field3name = $row["kpl"];
                                $field4name = $row["fueldate"];
                                $field5name = $row["fuelissue"];
                                $field6name = $row["fuelremaining"];
                                $field7name = $row["classification"];
                                $field8name = $row["addeddate"]; 
                                

                                echo '<tr> 
                                        <td>'.$field1name.'</td> 
                                        <td>'.$field2name.'</td> 
                                        <td>'.$field3name.'</td> 
                                        <td>'.$field4name.'</td> 
                                        <td>'.$field5name.'</td>
                                        <td>'.$field6name.'</td> 
                                        <td>'.$field7name.'</td> 
                                        <td>'.$field8name.'</td>  
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