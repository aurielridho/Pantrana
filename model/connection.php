<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'pantrana';
    
    if (!$conn = mysqli_connect($host, $username, $password, $dbName)) {
        die ('Database connection failed!');
    }
