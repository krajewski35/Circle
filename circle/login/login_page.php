<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Redirect to user settings if already logged in
if (!empty($_SESSION['email'])) {
    header("Location: $urlpath/user/user_settings.php");
    exit();
}

//Display header
$pagetitle = 'Log in';
include("$homepath/includes/header.php");
?>
  
<!-- Login form -->
<form action="handle_login.php" method="post" class="login">
    <fieldset class="login">
        <div class="login">
            <label for="email" class="login">Email Address</label><br>
            <input type="email" name="email" class="login" size="20" maxlength="255" /><br>
            <label for="password" class="login">Password</lablel><br>
            <input type="password" name="password" class="login" size="20" minlength="8" maxlength="255" /><br> <!-- Requiring password length of > 8 characters -->
        </div>
        <p><input type="submit" name="submit" class="button" value="Log in" /></p>
    </fieldset>
</form>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>