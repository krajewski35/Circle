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

//Retrieve user info from cookies
$user = array();
//DEBUGGING
foreach ($_SESSION as $session_value) {
    echo "Value: $session_value<br>";
}
$_SESSION['firstname'] = $user['firstname'];
$_SESSION['lastname'] = $user['lastname'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];
$_SESSION['member_type'] = $user['member_type'];
$_SESSION['member_purpose'] = $user['member_purpose'];
$_SESSION['regdate'] = $user['regdate'];

//Display content
echo "<h3>{$user['firstname']} {$user['lastname']}</h3>";
echo "<h4>{$user['username']}</h4>";
echo "<p class=\"userdetails\">" . 
    "<b>Email address:</b>" . $user['email'] . "<br>
    <b>User type:</b>" . ucfirst($user['member_type']) . "<br>
    <b>User status:</b>" . ucfirst($user['member_purpose']) . "</p>";
echo "<button type=\"button\" onclick=\"location.href='logout_page.php'\">Log out</button>";

//Include footer
include('includes/footer.php')
?>