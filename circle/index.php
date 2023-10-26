<?php
//Start session
session_start();

/*
//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';
*/

//Define homepaths
include($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');

//Display header
$pagetitle = 'Circle Volunteering';
include("$homepath/includes/header.php");

echo($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
?>

<header>
<div class= "content-wrap">
    <h2> testing</h2>
    <p>testing some more  </p>
    </div>
</header>
<ul>
    <li><a class="active" href="login_page.php">Home</a></li>
    <li><a href="login_page.php">Login</a></li>
    <li><a href="login_page.php">Contact Us</a></li>
    <li><a href="login_page.php">About Us</a></li>
</ul>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>