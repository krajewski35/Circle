<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to database
    require('/home/infost490f2305/mysqli_connect/mysqli_connect.php');

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
        $pagetitle = 'Delete account';
        include('includes/header.php');

        //Log out prompt
        echo "<h3>You have successfully deleted your account!</h3>";
        echo "<button type=\"button\" onclick=\"location.href='index.php'\">Back to home</button>";
    }
    else {
        $errors[] = 'Issue with deletion system. Please contact the Circle team for support.';
    }
}
else {
    echo "<h3>You ended up on this page by mistake</h3>";
    echo "<button type=\"button\" onclick=\"location.href='index.php'\">Back to home</button>";
}

//Include footer
include('includes/footer.php');
?>