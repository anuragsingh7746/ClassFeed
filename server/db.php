<?php
    $hostname = "localhost";
    $username = "root";
    $password = "_Mysqllocalsecured1.";
    try {
        $connection = new PDO("mysql:host=$hostname;dbname=feedback_system_3.0", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
    
date_default_timezone_set('Asia/Kolkata');
?>
