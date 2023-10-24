<?php
//Start session
session_start();

//Redirect to user page if already logged in
if (!empty($_SESSION['email'])) {
    //Redirect to user or admin page based on user admin status
    if ($_SESSION['is_admin'] == true) {
        header("Location: admin_page.php");
        exit();
    }
    else {
        header("Location: user_page.php");
        exit();
    }
}

//Display header
$pagetitle = 'Log in';
include('includes/header.php');
?>

<!-- Login form -->
<form action="handle_login.php" method="post" align="center" class="login">
    <fieldset class="login">
        <label for="email" class="login">Email Address</label>
        <input type="email" name="email" class="login" size="20" maxlength="255" />
        <label for="password" class="login">Password</lablel>
        <input type="password" name="password" class="login" size="20" minlength="8" maxlength="255" /> <!-- Requiring password length of 8-64 characters-->
        <p><input type="submit" name="submit" value="Log in" /></p>
    </fieldset>
</form>

<!--Include footer -->
<?php include('includes/footer.php')?>