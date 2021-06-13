<?php
    $authAppt="QM";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"qm_home.php\"";
    date_default_timezone_set("Asia/Dhaka");

    // include("dbcon.php");
    // if(isset($_POST["submit"])) {
        
    //     $bano = $_POST['bano'];
    //     $fuelAmount = $_POST['fuel-amnt'];
    //     $reqDate = date("Y-m-d");
        

    //     $quary = "UPDATE `fuel_req` SET status = 'not approved' WHERE bano = '".$bano."' AND status = 'requested'";
    //     $result1 = mysqli_query($con, $quary) or die(mysqli_error($con));

    //     $quary = "INSERT INTO fuel_req (bano, fueldate, fuelissue, status) VALUES ('".$bano."', '".$reqDate."', '".$fuelAmount."', 'approved')";
    //     $result2 = mysqli_query($con, $quary) or die(mysqli_error($con));

    //     $quary = "INSERT INTO polcomments (comment_subject, comment_text, comment_status, comment_link) VALUES ('Fuel Allocated', 'Vehicle: ".$bano." Amount: ".$fuelAmount."', '0', 'pol_appr_fuel.php')";
    //     $result3 = mysqli_query($con, $quary) or die(mysqli_error($con));

    //     if($result1 && $result2) {
    //         $quary = "commit";
    //         mysqli_query($con, $quary) or die(mysqli_error($con));
    //         echo '<script>alert("Fuel allocation successful");</script>';
    //         header("refresh:.1; url=qm_fuel_alloc.php");
    //     }

    //     else {
    //         $quary = "rollback";
    //         mysqli_query($con, $quary) or die(mysqli_error($con));
    //         echo '<script>alert("Fuel allocation was not successful");</script>';
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VDRA</title>
    <link rel="stylesheet" href="css/qm_vdra.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">VDRA</p>
                <form action="qm_fuel_alloc.php" method="post">
                    <label for="bano">Vehicle BA No:</label>
                    <input type="text" id="bano" name="bano" list="bano1" autocomplete="off" required><br>
                        <datalist id="bano1">
                        <?php
                            include("dbcon.php");
                            $quary = "SELECT bano from `vehicle`";
                            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
                            $i=0;
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?=$row["bano"];?>"><?=$row["bano"];?></option>
                                <?php
                                $i++;
                            }
                            mysqli_close($con);
                        ?>
                        </datalist>
                    <label for="yr">Year:</label>
                    <select id="yr" name="yr">
                        <option value=""></option>
                        <?php 
                            for($i = date('Y') ; $i >= 2000; $i--){
                                echo "<option>$i</option>";
                            }
                        ?>
                    </select>
                    <label for="month">Month:</label>
                    <select id="month" name="month">
                        <!-- <option value=""></option>
                        <?php
                        $monthArray = range(1, 12);
                        foreach ($monthArray as $month) {
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                            $fdate = date("F", strtotime("2015-$monthPadding-01"));
                            echo '<option value="'.$month.'">'.$fdate.'</option>';
                        }?> -->
                    </select>
                    <input type="submit" class="mnth" name="submit" value="Submit">
                </form>
            </div>
        </div>

    </section>

</body>
</html>

<script>
    $(document).ready(function () {
        $("#yr").change(function () {
            var option = document.getElementById("month").options;
            if (document.getElementById('yr').value == "2021") {
                $("#month").append('<option>OPEN</option>');
                $("#month").append('<option>DELIVERED</option>');
                }
            else {
                $("#month").append('<option>OPEN</option>');
                $("#month").append('<option>DELIVERED</option>');
                $("#month").append('<option>SHIPPED</option>');
                }
        });
    });
</script>