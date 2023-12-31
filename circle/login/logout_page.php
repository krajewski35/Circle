<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

//Erase session variables
$_SESSION['firstname'] = '';
$_SESSION['lastname'] = '';
$_SESSION['username'] = '';
$_SESSION['email'] = '';
$_SESSION['membertype'] = '';
$_SESSION['memberpurpose'] = '';
$_SESSION['regdate'] = '';

//Include header
$pagetitle = 'Log out';
include("$homepath/includes/header.php");

//Log out prompt
echo "<h3>You have successfully logged out!</h3>";
echo "<button type=\"button\" class=\"button\" onclick=\"location.href='login_page.php'\">Log in</button>";

//Include footer
include("$homepath/includes/footer.php");
?>