<?php echo "Not authorized" ;
    session_start();
    if(is_null($_SESSION['toDate'])){
        switch ($_SESSION['appt']) {
            case "QM":
                header( "refresh:.5; url=qm_home.php" ); 
                break;
            case "MT":
                header( "refresh:.5; url=mt_home.php" ); 
                break;
            case "POL":
                header( "refresh:.5; url=pol_home.php" ); 
                break;
            default:
                header( "refresh:.5; url=login.php" ); 
          }    
    }

    else {
        echo "<br> You are currently not appointed";
    }

?>