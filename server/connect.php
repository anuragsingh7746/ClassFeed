<?php

    $host = "localhost";
    $user = "root";
    $pass = "_Mysqllocalsecured1.";
    $dbname = "feedback_system_3.0";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if($conn->connect_error){
        die("Error connecting to the server: " . $conn->connect_errno);
    }
date_default_timezone_set('Asia/Kolkata');
?>
