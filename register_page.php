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
$pagetitle = 'Register User';
include('includes/header.php');
?>

<!-- User Registration Form -->
<form action="handle_register.php" method="post" align="center" class="login">
    <fieldset class="login">
        <!-- First name -->
        <label for="firstname" class="login">First Name</label>
        <input type="text" name="firstname" class="login" size="20" maxlength="255" />
        <!-- Last name -->
        <label for="lastname" class="login">Last Name</label>
        <input type="text" name="lastname" class="login" size="20" maxlength="255" />
        <!-- Username -->
        <label for="username" class="login">Public Username</label>
        <input type="text" name="username" class="login" size="20" maxlength="31" />
        <!-- Email Address -->
        <label for="email" class="login">Email Address</label>
        <input type="email" name="email" class="login" size="20" maxlength="255" />
        <!-- Confirm Email -->
        <label for="email" class="login">Confirm Email Address</label>
        <input type="email" name="emailconfirm" class="login" size="20" maxlength="255" />
        <!-- Password -->
        <label for="password" class="login">Password</label>
        <input type="password" name="password" class="login" size="20" maxlength="255" />
        <!-- Confirm Password -->
        <label for="password" class="login">Confirm Password</label>
        <input type="password" name="passwordconfirm" class="login" size="20" maxlength="255" />
        <!-- Member Type -->
        <select name="membertype" id="membertype">
            <?php 
            //Add dropdown option for each member type
            $member_type = array("individual", "organization");
            foreach ($member_type as $type) {
                echo "<option value=\"$type\">ucfirst($type)</option>";
            }
            ?>
        </select>
        <!-- Member Purpose -->
        <select name="memberpurpose" id="memberpurpose">
            <?php 
            //Add dropdown option for each member purpose
            $member_purpose = array(
                array("volunteer", "I want to volunteer"),
                array("cause", "I need help or support for my cause"),
                array("sponsor", "I want to provide rewards for volunteers")
            );
            foreach ($member_purpose as $purpose) {
                echo "<option value=\"ucfirst($purpose[0])\">$purpose[1]</option>";
            }
            ?>
        </select>
        <!-- Register -->
        <p><input type="submit" name="submit"  class="register" value="Register" /></p>
    </fieldset>
</form>