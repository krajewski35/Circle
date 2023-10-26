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
//Redirect to homepage if user is not admin
elseif ($_SESSION['memberpurpose'] != 'admin') {
    header("Location: $urlpath/index.php");
    exit();
}

//Make sure request to delete is directly from user list
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Connect to database
    require($dbpath);

    //Run deletion query
    $q = "DELETE FROM users WHERE email='{$_POST['email']}'";
    $r = @mysqli_query($dbc, $q);
    mysqli_close($dbc);

    //Check if deletion successful
    if ($r) {
        //Include header
        $pagetitle = 'Account Deletion';
        include("$homepath/includes/header.php");

        //Deletion prompt
        echo "<h3>You have successfully deleted this account: {$_POST['email']}</h3>";
        echo "<button type=\"button\" onclick=\"location.href='user_list.php'\">Back to user list</button>";
    }
    else {
        $errors[] = 'Issue with deletion system. Please contact the Circle team for support.';
    }
}

//Display error if on page by mistake
else {
    //Include header
    $pagetitle = 'Error';
    include("$homepath/includes/header.php");

    echo "<h3>You ended up on this page by mistake</h3>";
    echo "<button type=\"button\" onclick=\"location.href='$urlpath/index.php'\">Back to home</button>";
}

//Include footer
include("$homepath/includes/footer.php");
?>