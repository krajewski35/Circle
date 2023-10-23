<?php
    # CONNECTING TO DATABASE
    
    //Database Information
    define('DB_HOST', 'localhost');
    define('DB_USER', '');
    define('DB_PASSWORD', '');
    define('DB_NAME', '');
    
    //Connect to Database
    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
    
    //Set character set
    mysqli_set_charset($dbc, 'utf8');
?>