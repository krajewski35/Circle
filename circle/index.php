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
    <div>
        <h3>It's where causes receive the support they need</h3>
        <p>Causes can easily post listings on Circle to get the help they need. No more difficult outreach!</p>
    </div>
    <div>
        <p>img here</p>
    </div>
</div>
<div class="box">
    <div>
        <!-- <h3>It's where sponsors can reward volunteers for their time.</h3>
        <p>Volunteers receive points they can later exchange for rewards on Circle. Businesses large and small 
            can provide them to connect with volunteers and promote their brand.</p> -->
    <div class="box-text">
        <h3>Circle is where volunteering comes in full circle</h3>
    </div>
    <div class="box-img">
        <img src="images/volunteer.png" >
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>