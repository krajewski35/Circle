<?php
//Start session
session_start();

//Redirect to user page if already logged in
if (!empty($_SESSION['email'])) {
    //Redirect to user or admin page based on user admin status
    if ($_SESSION['member_type'] == 'admin') {
        header("Location: admin_page.php");
        exit();
    }
    else {
        header("Location: user_settings.php");
        exit();
    }
}

//Display header
$pagetitle = 'Log in';
include('includes/header.php');

//Retrieve user info from session

?>



<!--Include footer -->
<?php include('includes/footer.php')?>