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
    <title>MT NCO List</title>
    <link rel="stylesheet" href="css/qm_qm_list.css">
</head>
<body>
<?php include 'inc.style.php'; ?>
    <section class="hero">
        <div class="container1">
            <div class="left-col">
                <p class="subhead">MT NCO List</p>
                    <?php 
                        include("dbcon.php");
                        $quary = "SELECT * FROM `user` where appt = 'MT'";
                        $result = mysqli_query($con, $quary) or die(mysqli_error($con));


                        echo '<table> 
                            <tr> 
                                <th> Soinik No </th> 
                                <th> Rank </th> 
                                <th> Name </th> 
                                <th> From </th> 
                                <th> To </th> 
                            </tr>';

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["personalnum"];
                                $field2name = $row["rank"];
                                $field3name = $row["username"];
                                $field4name = $row["fromdate"];
                                $field5name = $row["todate"]; 
                                if($field5name == "") {
                                    $field5name = "Running";
                                }

                                echo '<tr> 
                                        <td>'.$field1name.'</td> 
                                        <td>'.$field2name.'</td> 
                                        <td>'.$field3name.'</td> 
                                        <td>'.$field4name.'</td> 
                                        <td>'.$field5name.'</td> 
                                    </tr>';
                            }
                            echo '</table>';
                            $result->free();
                        } 
                    ?>                
            </div>
        </div>

    </section>
</body>
</html>