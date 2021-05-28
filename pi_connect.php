<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="pi_connect.php" method="get">
        <input type="text" id="search" name="search" autocomplete="off" placeholder="Search by BA Number" required>
        <input type="submit" name="search-button" value="Search">
    </form> -->

    <?php 
                        include("dbcon.php");
                        $curDate = date("Y-m-d");
                        if(isset($_GET["search"])) {
        
                            $bano = $_GET["search"];
                            $quary = "SELECT * FROM `fuel_req` WHERE bano = '".$bano."' AND fueldate = '".$curDate."'";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        }
                        // else {
                        //     $quary = "SELECT * FROM `fuel_req` WHERE fueldate = '".$curDate."'";
                        //     $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                        // }


                        // echo '<table> 
                        //     <tr> 
                        //         <th> BA NO </th> 
                        //         <th> Amount(Liter) </th> 
                        //         <th> Status </th> 
                        //     </tr>';

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
                                

                                // echo '<tr> 
                                //         <td>'.$field1name.'</td> 
                                //         <td>'.$field2name.'</td> 
                                //         <td>'.$field3name.'</td> 
                                //     </tr>';
                            }
                            $result->free();
                        } 
                        
                        // $field1name = "'".$field1name."'";
                        // $field2name = "'".$field2name."'";
                        // $field3name = "'".$field3name."'";

                        $data = array(
                            'BA No' => $field1name,
                            'Fuel'  => $field2name,
                            'Status'  => $field3name
                        );
                        
                        echo json_encode($data);
                    ?>
</body>
</html>