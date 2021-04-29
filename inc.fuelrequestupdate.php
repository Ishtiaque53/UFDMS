<?php 
    include("dbcon.php");
    date_default_timezone_set("Asia/Dhaka");
    $currentdate = date("Y-m-d");
    $quary = "SELECT fueldate,status from `fuel_req`";
    $result = mysqli_query($con, $quary) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $reqDate = $row['fueldate'];
            
            $diff = date_diff(date_create($currentdate),date_create($reqDate));
            if($diff->format('%r%d')<0){
                $quary = "UPDATE fuel_req SET status ='not approved' where fueldate='".$reqDate."' AND status='requested'";
                $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));
                $quary = "UPDATE fuel_req SET status ='not dispensed' where fueldate='".$reqDate."' AND status='approved'";
                $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));
            }
        }
    }
    $result->free();
?>