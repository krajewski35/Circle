<?php
//Start session
session_start();

//Display header
$pagetitle = 'Circle Volunteering';
include('~/circle/includes/header.php');
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
include('~/circle/includes/footer.php');
?>