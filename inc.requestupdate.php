<?php 
    include("dbcon.php");
    date_default_timezone_set("Asia/Dhaka");
    $currentdate = date("Y-m-d");
    $currenttime = date('H:i:s');
    $quary = "SELECT time,date,status from `veh_mov_req`";
    $result = mysqli_query($con, $quary) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $movDate = $row['date'];
            $movTime = $row['time'];
            $diff = date_diff(date_create($currentdate),date_create($movDate));
            if($diff->format('%r%d')<0){
                $quary = "UPDATE veh_mov_req SET status ='not approved' where date='".$movDate."' AND status='requested'";
                $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));
                $result1->free();
            }
            elseif($diff->format('%r%d')==0){
                $timeDiff = date_diff(date_create($currenttime),date_create($movTime));;
                if($timeDiff->format('%r%H:%i:%s')<0){
                    $quary = "UPDATE veh_mov_req SET status ='not approved' where time='".$movTime."' AND status='requested'";
                    $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));
                }
            }
        }
    }
    $result->free();
?>