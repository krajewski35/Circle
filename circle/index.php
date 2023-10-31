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
        <h2>Circle is where volunteering comes in full circle!</h2>
        <h2>• People • Causes • Rewards</h2>
        <br>
        <button class="button_reverse">Help in your community</button>
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
        <h2>You earned it!</h2>
        <h2>Redeem your volunteer rewards now</h2>
        <h2>• Restaurants • Local businesses • Entertainment</h2>
        <br>

        <button class="button_reverse">Help in your community</button>
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>