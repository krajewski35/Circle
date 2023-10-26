<?php
//Start session
session_start();

//Redirect to user settings if already logged in
if (!empty($_SESSION['email'])) {
    header("Location: ../user/user_settings.php");
    exit();
}

//Define homepath
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';

//Include header
$pagetitle = 'Register User';
include("$homepath/includes/header.php");
?>

<!-- User Registration Form -->
<form action="handle_register.php" method="post" align="center" class="login">
    <fieldset class="login">
        <p>
            <p><b>*Required Field</b></p>
            <!-- First name -->
            <label for="firstname" class="login">*First Name</label><br>
            <input type="text" name="firstname" class="login" size="20" maxlength="255" required /><br>
            <!-- Last name -->
            <label for="lastname" class="login">*Last Name</label><br>
            <input type="text" name="lastname" class="login" size="20" maxlength="255" required /><br>
            <!-- Username -->
            <label for="username" class="login">*Public Username</label><br>
            <input type="text" name="username" class="login" size="20" maxlength="31" required /><br>
            <!-- Email Address -->
            <label for="email" class="login">*Email Address</label><br>
            <input type="email" name="email" class="login" size="20" maxlength="255" required /><br>
            <!-- Confirm Email -->
            <label for="email" class="login">*Confirm Email Address</label><br>
            <input type="email" name="emailconfirm" class="login" size="20" maxlength="255" required /><br>
            <!-- Password -->
            <label for="password" class="login">*Password (Must be greater than 8 characters)</label><br>
            <input type="password" name="password" class="login" size="20" maxlength="255" required /><br>
            <!-- Confirm Password -->
            <label for="password" class="login">*Confirm Password</label><br>
            <input type="password" name="passwordconfirm" class="login" size="20" maxlength="255" required /><br>
            <!-- Member Type -->
            <label for="membertype" class="login">*Are you an individual or organization?</label><br>
            <select name="membertype" id="membertype" required>
                <?php 
                //Add dropdown option for each member type
                $membertype = array("individual", "organization");
                echo "<option value=\"\" selected disabled hidden>Select an Option</option>";
                foreach ($membertype as $type) {
                    $uctype = ucfirst($type);
                    echo "<option value=\"$type\">$uctype</option>";
                }
                ?>
            </select><br>
            <!-- Member Purpose -->
            <label for="memberpurpose" class="login">*What is your role?</label><br>
            <select name="memberpurpose" id="memberpurpose" required>
                <?php 
                //Add dropdown option for each member purpose
                $memberpurpose = array(
                    'volunteer' => 'I want to volunteer',
                    'cause' => 'I need help or support for my cause',
                    'sponsor' => 'I want to provide rewards for volunteers',
                );
                echo "<option value=\"\" selected disabled hidden>Select an Option</option>";
                foreach ($memberpurpose as $purpose => $description) {
                    echo "<option value=\"$purpose\">$description</option>";
                }
                ?>
            </select><br>
        </p>
        <!-- Register -->
        <p><input type="submit" name="submit"  class="register" value="Register" /></p>
    </fieldset>
</form>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>