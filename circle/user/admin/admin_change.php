<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: ../../login/login_page.php");
    exit();
}
//Redirect to homepage if user is not admin
elseif ($_SESSION['memberpurpose'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

//Define homepath
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';

//Make sure request to change is directly from user list
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Connect to database
    require('/home/infost490f2305/mysqli_connect/mysqli_connect.php');

    //Change admin status for query based on previous admin status (volunteer represents not admin)
    $admin_status = $_POST['admin'] ? 'volunteer' : 'admin';

    //Run update query
    $q = "UPDATE users SET memberpurpose='$admin_status' WHERE email='{$_POST['email']}'";
    $r = @mysqli_query($dbc, $q);
    mysqli_close($dbc);

    //Check if change successful
    if ($r) {
        //Include header
        $pagetitle = 'Account Admin Change';
        include("$homepath/includes/header.php");

        //Change prompt
        echo "<h3>You have successfully changed this account's admin status: {$_POST['email']}</h3>";
        echo "<button type=\"button\" onclick=\"location.href='user_list.php'\">Back to user list</button>";
    }
    else {
        $errors[] = 'Issue with deletion system. Please contact the Circle team for support.';
    }

//Display error if on page by mistake
} else {
    //Include header
    $pagetitle = 'Error';
    include("$homepath/includes/header.php");

    echo "<h3>You ended up on this page by mistake</h3>";
    echo "<button type=\"button\" onclick=\"location.href='../../index.php'\">Back to home</button>";
}

//Include footer
include("$homepath/includes/footer.php");
?>