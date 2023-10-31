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
        <h2>Circle is where volunteering comes in full circle</h2>
        <p>Circle is a one stop platform where volunteers and causes come together through an inutitive interface.
            In return for the time and skills volunteers provide, they receive points they can later exchnage for 
            sponsor provided rewards. This encourages volunteers to help, causes and individuals a convient way to
            ask for help, and gives sponsors a way to promote their brand.</p>
    </div>
    <div>
        <p>img here</p>
    </div>
</div>


<?php
//Include footer
include("$homepath/includes/footer.php");
?>