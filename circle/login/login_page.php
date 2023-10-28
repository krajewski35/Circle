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

<style>
form {
  width: 50%;
  padding: 20px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 6px;
  background: #e5e5e5;
  box-shadow: 4.0px 8.0px 8.0px hsl(0deg 0% 0% / 0.38);
}
input {
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: calc(100% - 10px);
  padding: 5px;
  vertical-align: bottom;
  top: -10px;
}
</style>    
<!-- Login form -->
<form action="handle_login.php" method="post" class="login">
    <fieldset class="login">
        <p>
            <label for="email" class="login">Email Address</label><br>
            <input type="email" name="email" class="login" size="20" maxlength="255" /><br>
            <label for="password" class="login">Password</lablel><br>
            <input type="password" name="password" class="login" size="20" minlength="8" maxlength="255" /><br> <!-- Requiring password length of > 8 characters -->
        </p>
        <p><input type="submit" name="submit" value="Log in" /></p>
    </fieldset>
</form>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>