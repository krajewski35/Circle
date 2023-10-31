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
    <div class="box-text">
        <h3>Circle is where volunteering comes in full circle!</h3>
        <br>
        <button>
            <h3>Become a part of your Community</h3>
        </button>
    </div>
    <div class="box-img">
        <img src="images/volunteer.png" >
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>