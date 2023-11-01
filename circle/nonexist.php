<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: $urlpath/login/login_page.php");
    exit();
}

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Display header
//$pagetitle = 'Circle Volunteering';
$pagetitle = 'This page does not exist';
include("$homepath/includes/header.php");
?>

<h3>This feature does not exist yet. Maybe we will develop it some time in the future.</h3>
<button type="button" class="button" onclick=<?php echo "\"location.href='$urlpath/index.php'\"" ?> >Back to home</button>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>