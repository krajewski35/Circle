<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Display header
//$pagetitle = 'Circle Volunteering';
$pagetitle = 'Homepage';
include("$homepath/includes/header.php");
?>

<div class="content-wrap">
    <img src="images/mke.png" class="mke"><br>
    <h2>Where volunteering comes in full circle!</h2>
    <a href=<?php echo "\"$urlpath/login/register_page.php\""; ?> ><button class="button">Join Circle</button></a>
</div>
<div class="side-by-side">
    <div class="box">
        <div class="box-text">
            <h2>Circle is a one-stop app for everyone!</h2>
            <h2>• People • Causes • Sponsors •</h2>
            <a href=<?php echo "\"$urlpath/nonexist.php\""; ?> ><button class="button-reverse">Help in your community</button></a>
        </div>
        <div class="box-img">
            <img src="images/1.png">
        </div>
    </div>
    <div class="box">
        <div class="box-img">
            <img src="images/rewards.png">
        </div>
        <div class="box-text">
            <h2>Receive rewards for helping out!</h2>
            <h2>• Restaurants • Local businesses • Entertainment •</h2>

        <a href=<?php echo "\"$urlpath/nonexist.php\""; ?> > <button class="button-reverse">Check out rewards</button></a>
        </div>
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>