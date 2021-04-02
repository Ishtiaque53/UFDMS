<?php

    session_start();
    session_unset();
    session_destroy();

    echo "<h2>Logged out</h2>";
    header( "refresh:.5; url=login.php" ); 

?>