<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

//Erase session variables
$_SESSION['username'] = '';
$_SESSION['fname'] = '';
$_SESSION['lname'] = '';
$_SESSION['email'] = '';
$_SESSION['is_admin'] = '';

$_SESSION['firstname'] = '';
$_SESSION['lastname'] = '';
$_SESSION['username'] = '';
$_SESSION['email'] = '';
$_SESSION['member_type'] = '';
$_SESSION['member_purpose'] = '';
$_SESSION['regdate'] = '';

//Include header
$pagetitle = 'Log out';
include('includes/header.php');

//Log out prompt
echo "<h3>You have successfully logged out!</h3>";
echo "<button type=\"button\" onclick=\"location.href='login_page.php'\">Log in</button>";

//Include footer
include('includes/footer.php');
?>