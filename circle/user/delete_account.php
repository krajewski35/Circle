<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';
$dbpath = '/home/infost490f2305/mysqli_connect/mysqli_connect.php';

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: $urlpath/login/login_page.php");
    exit();
}

//Make sure request to delete is directly from user settings and is not admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['memberpurpose'] != 'admin') {

    //Connect to database
    require($dbpath);

    //Run deletion query
    $q = "DELETE FROM users WHERE email='{$_SESSION['email']}'";
    $r = @mysqli_query($dbc, $q);
    mysqli_close($dbc);

    //Check if deletion successful
    if ($r) {
        //Erase session variables
        $_SESSION['firstname'] = '';
        $_SESSION['lastname'] = '';
        $_SESSION['username'] = '';
        $_SESSION['email'] = '';
        $_SESSION['membertype'] = '';
        $_SESSION['memberpurpose'] = '';
        $_SESSION['regdate'] = '';

        //Include header
        $pagetitle = 'Account Deletion';
        include("$homepath/includes/header.php");

        //Deletion prompt
        echo "<h3>You have successfully deleted your account!</h3>";
        echo "<button type=\"button\" onclick=\"location.href='$urlpath/index.php'\">Back to home</button>";
    }
    else {
        $errors[] = 'Issue with deletion system. Please contact the Circle team for support.';
    }

//Display error to prevent accidental deletion of admin accounts
} elseif ($_SESSION['memberpurpose'] == 'admin') {
    //Include header
    $pagetitle = 'Error';
    include("$homepath/includes/header.php");

    echo "<h3>You cannot delete your account as an admin!</h3>";
    echo "<p>Please ask to delete your account to a different admin under the user list.</p>";
    echo "<button type=\"button\" onclick=\"location.href='user_settings.php'\">Back to user settings</button>";
}

//Display error if on page by mistake
else {
    //Include header
    $pagetitle = 'Error';
    include("$homepath/includes/header.php");

    echo "<h3>You ended up on this page by mistake</h3>";
    echo "<button type=\"button\" onclick=\"location.href='../index.php'\">Back to home</button>";
}

//Include footer
include("$homepath/includes/footer.php");
?>