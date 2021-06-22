<?php
    $authAppt="POL";
    include 'inc.authentication.php';
    $_COOKIE['home'] = "\"pol_home.php\"";
    date_default_timezone_set("Asia/Dhaka");
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
                <form action="pol_vdra_gen.php" method="post">
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
                        <option value="0">Select Year</option>
                        <?php 
                            for($i = date('Y') ; $i >= 2000; $i--){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <label for="month">Month:</label>
                    <select id="month" name="month">
                        <option value="0">Select Month</option>
                        <?php
                        $monthArray = range(1, 12);
                        foreach ($monthArray as $month) {
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                            $fdate = date("F", strtotime("2015-$monthPadding-01"));
                            echo '<option value="'.$month.'">'.$fdate.'</option>';
                        }?>
                    </select>
                    <input type="submit" name="submit" value="Submit" onclick="return Validate()">
                </form>
            </div>
        </div>

    </section>

<script type="text/javascript">
    function Validate() {
        var yr = document.getElementById("yr");
        var month = document.getElementById("month");
        if (yr.value == "0") {
            //If the "Please Select" option is selected display error.
            alert("Please select year!");
            return false;
        }
        if (month.value == "0") {
            //If the "Please Select" option is selected display error.
            alert("Please select month!");
            return false;
        }
        return true;
    }
</script>

</body>
</html>
