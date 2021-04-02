<?php
    session_start();
    if(isset($_SESSION['username'])  && isset($_SESSION['appt']) && is_null($_SESSION['toDate'])) {
        if($_SESSION['appt'] <> $authAppt){
            header("location:unauthorized.php");
        }        
    }
    elseif(is_null($_SESSION['toDate'])) {
        header("location:login.php");
    }

    else {
        header("location:unauthorized.php");
    }

?>