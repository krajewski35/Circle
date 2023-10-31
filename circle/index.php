<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Display header
//$pagetitle = 'Circle Volunteering';
$pagetitle = '';
include("$homepath/includes/header.php");
?>

<div class= "content-wrap">
    <img src="images/mke.png" class="mke">
</div>
<div class="box">
    <div class="box-text">
        <h2 style= "font-family: Trebuchet MS, Helvetica, sans-serif; font-size: 30px;" >Circle is where volunteering comes in full circle!</h2>
        <br><h2 style= "font-family: Trebuchet MS, Helvetica, sans-serif; font-size: 30px;">• People • Causes • Rewards</h2>
        <br>
        <a href= "https://infost490f2305.soisweb.uwm.edu/circle/login/register_page.php" ><button class="button_reverse">Help in your community</button> </a>
    </div>
    <div class="box-img">
        <img src="images/1.png" >
    </div>
</div>
<div class="box">
    <div class="box-img">
        <img src="images/rewards.png" >
    </div>
    <div class="box-text">
        <h2 style= "font-family: Trebuchet MS, Helvetica, sans-serif; font-size: 30px;">Circle Volunteering Rewards!</h2>
        <br><h2 style= "font-family: Trebuchet MS, Helvetica, sans-serif; font-size: 30px;">• Restaurants • Local businesses • Entertainment</h2>
        <br>

       <a href= "https://infost490f2305.soisweb.uwm.edu/circle/login/login_page.php"> <button class="button_reverse">Help in your community</button></a>
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>