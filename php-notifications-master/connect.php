<?php

$serverName = "localhost";
$userName = "root";
$password = "root";
$dbName = "ufdms";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}
?>