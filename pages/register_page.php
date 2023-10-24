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
$pagetitle = 'Register User';
include('includes/header.php');
?>

<!-- User Registration Form -->
<form action="handle_register.php" method="post" align="center" class="login">
    <fieldset class="login">
        <p>
            <!-- First name -->
            <label for="firstname" class="login">First Name</label><br>
            <input type="text" name="firstname" class="login" size="20" maxlength="255" /><br>
            <!-- Last name -->
            <label for="lastname" class="login">Last Name</label><br>
            <input type="text" name="lastname" class="login" size="20" maxlength="255" /><br>
            <!-- Username -->
            <label for="username" class="login">Public Username</label><br>
            <input type="text" name="username" class="login" size="20" maxlength="31" /><br>
            <!-- Email Address -->
            <label for="email" class="login">Email Address</label><br>
            <input type="email" name="email" class="login" size="20" maxlength="255" /><br>
            <!-- Confirm Email -->
            <label for="email" class="login">Confirm Email Address</label><br>
            <input type="email" name="emailconfirm" class="login" size="20" maxlength="255" /><br>
            <!-- Password -->
            <label for="password" class="login">Password (Must be greater than 8 characters)</label><br>
            <input type="password" name="password" class="login" size="20" maxlength="255" /><br>
            <!-- Confirm Password -->
            <label for="password" class="login">Confirm Password</label><br>
            <input type="password" name="passwordconfirm" class="login" size="20" maxlength="255" /><br>
            <!-- Member Type -->
            <label for="membertype" class="login">Are you an individual or organization?</label><br>
            <select name="membertype" id="membertype">
                <?php 
                //Add dropdown option for each member type
                $member_type = array("", "individual", "organization");
                foreach ($member_type as $type) {
                    $uctype = ucfirst($type);
                    echo "<option value=\"$type\">{$uctype}</option>";
                }
                ?>
            </select><br>
            <!-- Member Purpose -->
            <label for="memberpurpose" class="login">What is your role?</label><br>
            <select name="memberpurpose" id="memberpurpose">
                <?php 
                //Add dropdown option for each member purpose
                $member_purpose = array(
                    '' => '',
                    'volunteer' => 'I want to volunteer',
                    'cause' => 'I need help or support for my cause',
                    'sponsor' => 'I want to provide rewards for volunteers',
                );
                foreach ($member_purpose as $purpose => $description) {
                    echo "<option value=\"$purpose\">$description</option>";
                }
                ?>
            </select><br>
        </p>
        <!-- Register -->
        <p><input type="submit" name="submit"  class="register" value="Register" /></p>
    </fieldset>
</form>