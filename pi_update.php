<?php 
    include("dbcon.php");
    date_default_timezone_set("Asia/Dhaka");
    $curDate = date("Y-m-d");
    if(isset($_GET["update"])) {

        $bano = $_GET["update"];
        

        $quary = "UPDATE `fuel_req` SET status = 'dispensed' WHERE bano = '".$bano."' AND fueldate = '".$curDate."' AND status = 'approved'";
        $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

        $quary = "SELECT * FROM `vehicle` WHERE bano = '".$bano."'";
            $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
            if (mysqli_num_rows($result2) > 0) {
                $row1 = $result2->fetch_assoc();
                $fuel = $row1["fuelremaining"];
            }

        
        $quary = "SELECT * FROM `fuel_req` WHERE bano = '".$bano."' AND fueldate = '".$curDate."' AND status = 'dispensed'";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));
    }
    
    if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $field1name = $row["bano"];
            $field2name = $row["fuelissue"];
            $field3name = $row["status"];
            $fuel = $fuel + $field2name;
            $quary = "UPDATE `vehicle` SET fueldate = '".$curDate."', fuelissue = '".$field2name."', fuelremaining = '".$fuel."' WHERE bano = '".$bano."'";
            $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));
    } 
    else{
        $quary = "SELECT * FROM `vehicle` WHERE bano = '".$bano."'";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0){
            $field1name = $bano;
            $field2name = '0';
            $field3name = 'Not requested or not approved';
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
