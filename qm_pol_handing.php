<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";

    include("dbcon.php");

    $quary = "SELECT personalnum, rank, username from `user` where appt = 'POL' and todate is null ";
    $result = mysqli_query($con, $quary) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $_COOKIE['prev-snNo'] = '"'.$row["personalnum"].'"';
        $_COOKIE['prev-rank'] = '"'.$row["rank"].'"';
        $_COOKIE['prev-name'] = '"'.$row["username"].'"';
    } 
    else {
        echo '<script>alert("Old POL NCO not found");</script>';
        header("refresh:.1; url=qm_home.php");
    }

    $quary = "SELECT personalnum, rank, username, password from `user_req` where appt = 'POL' and status = 'requested'";
    $result = mysqli_query($con, $quary) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $_COOKIE['new-snNo'] = '"'.$row["personalnum"].'"';
        $_COOKIE['new-rank'] = '"'.$row["rank"].'"';
        $_COOKIE['new-name'] = '"'.$row["username"].'"';
        $password = $row["password"];
    } 
    else {
        echo '<script>alert("No POL NCO has requested");</script>';
        header("refresh:.1; url=qm_home.php");
    }

     if(isset($_POST["approve"])) {
        
         $snNo = $_POST['new-SNNo'];
         $rank = $_POST['new-rank'];
         $name = $_POST['new-name'];
         $fromDate = new DateTime();
         
         $quary = "UPDATE `user` SET todate = '".$fromDate->format('Y-m-d H:i:s')."' WHERE appt = 'POL' and todate is null";
         $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

         $quary = "INSERT INTO user (personalnum, rank, username, password, fromdate, appt) VALUES ('".$snNo."', '".$rank."', '".$name."', '".$password."', '".$fromDate->format('Y-m-d H:i:s')."', 'POL')";
         $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

         $quary = "UPDATE `user_req` SET status = 'approved' WHERE appt = 'POL' and status = 'requested'";
         $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));

         if($result1 && $result2 && $result3) {
             $quary = "commit";
             mysqli_query($con, $quary) or die(mysqli_error($con));
             echo '<script>alert("POL NCO Change Successful");</script>';
             header("refresh:.1; url=qm_home.php");
         }

         else {
             $quary = "rollback";
             mysqli_query($con, $quary) or die(mysqli_error($con));
             echo '<script>alert("POL NCO Change was not successful");</script>';
         }
    }

    if(isset($_POST["not-approved"])) {
             
        $quary = "UPDATE `user_req` SET status = 'not approved' WHERE appt = 'POL' and status = 'requested'";
        $result4 = mysqli_query($con, $quary) or die(mysqli_error($con));

        if($result4) {
            $quary = "commit";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("POL NCO was not approved");</script>';
            header("refresh:.1; url=qm_home.php");
        }

        else {
            $quary = "rollback";
            mysqli_query($con, $quary) or die(mysqli_error($con));
            echo '<script>alert("Not approval was not successful");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POL NCO Handing</title>
    <link rel="stylesheet" href="css/qm_pol_handing.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">POL NCO</p>
                <form action="qm_pol_handing.php" method="post">
                    <div class="old">
                        <h3>OLD POL NCO</h3>
                        <label for="prev-SNNo">Soinik No:</label><br>
                        <input type="text" id="prev-SNNo" name="prev-SNNo" value=<?php echo $_COOKIE['prev-snNo']?> readonly><br>
                        <label for="prev-rank">Rank:</label><br>
                        <input type="text" id="prev-rank" name="prev-rank" value=<?php echo $_COOKIE['prev-rank']?> readonly><br>
                        <label for="new-name">Name:</label><br>
                        <input type="text" id="prev-name" name="prev-name" value=<?php echo $_COOKIE['prev-name']?> readonly><br>
                    </div>
                    <div class="new">
                        <h3>NEW POL NCO</h3>
                        <label for="new-SNNo">Soinik No:</label><br>
                        <input type="text" id="new-SNNo" name="new-SNNo" value=<?php echo $_COOKIE['new-snNo']?> readonly><br>     
                        <label for="new-rank">Rank:</label><br>
                        <input type="text" id="new-rank" name="new-rank" value=<?php echo $_COOKIE['new-rank']?> readonly><br>
                        <label for="prev-name">Name:</label><br>
                        <input type="text" id="new-name" name="new-name" value=<?php echo $_COOKIE['new-name']?> readonly><br>
                    </div>                   
                    <input type="submit" class="approve" name="approve" value="Approve">
                    <input type="submit" class="not-approved" name="not-approved" value=" Not Approved">
                </form>
            </div>
        </div>

    </section>

</body>
</html>