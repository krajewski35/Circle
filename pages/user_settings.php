<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}
//Redirect to admin page if user is admin
elseif ($_SESSION['member_type'] == 'admin') {
    header("Location: admin_page.php");
    exit();
}

//Include header
$pagetitle = 'User Settings';
include('includes/header.php');

//Display content
echo "<h3>{$_SESSION['firstname']} {$_SESSION['lastname']}</h3>";
echo "<h4>{$_SESSION['username']}</h4>";
echo "<p class=\"userdetails\">" . 
    "<b>Email address:</b>" . $_SESSION['email'] . "<br>
    <b>User type:</b>" . ucfirst($_SESSION['member_type']) . "<br>
    <b>User status:</b>" . ucfirst($_SESSION['member_purpose']) . "</p>";
echo "<button type=\"button\" onclick=\"location.href='logout_page.php'\">Log out</button>";

//Include footer
include('includes/footer.php')
?>