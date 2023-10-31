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
        <h3>Circle is where volunteering comes in full circle!</h3>
        <br>
        <h3>Become a part of your Community</h3>
    </div>
    <div>
        <img src="images/volunteer.png" >
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>