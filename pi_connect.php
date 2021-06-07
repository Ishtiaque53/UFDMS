<?php 
    include("dbcon.php");
    date_default_timezone_set("Asia/Dhaka");
    $curDate = date("Y-m-d");
    if(isset($_GET["search"])) {

        $bano = $_GET["search"];
        $quary = "SELECT * FROM `fuel_req` WHERE bano = '".$bano."' AND fueldate = '".$curDate."' AND status = 'approved'";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));
    }

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
    else{
        $quary = "SELECT * FROM `vehicle` WHERE bano = '".$bano."'";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0){
            $field1name = $bano;
            $field2name = '0';
            $field3name = 'Not requested or approved';
        }
        else{
            $field1name = $bano;
            $field2name = '0';
            $field3name = 'No Such Vehicle';
        }
    }
    

    $data = array(
        'BA No' => $field1name,
        'Fuel'  => $field2name,
        'Status'  => $field3name
    );
    
    echo json_encode($data);
?>
