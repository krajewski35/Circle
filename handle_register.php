<?php
//Include header
$pagetitle = 'Registration';
include('includes/header.php');

if ($SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to database
    require('mysqli_connect.php');

    //Check and retrieve login information
    $errors = array();
    //First name
    if (!empty($_POST['firstname'])) {
        $fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
    } else {
        $errors[] = 'You forgot to enter your first name';
    }
    //**CONT
}