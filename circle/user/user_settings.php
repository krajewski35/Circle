<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: $urlpath/login/login_page.php");
    exit();
}

//Include header
$pagetitle = 'User Settings';
include("$homepath/includes/header.php");

//Display content
echo "<h2>{$_SESSION['firstname']} {$_SESSION['lastname']}</h2>";
echo "<h3>{$_SESSION['username']}</h3>";
echo "<p class=\"userdetails\">" . 
    "<b>Email address: </b>" . $_SESSION['email'] . "<br>
    <b>User type: </b>" . ucfirst($_SESSION['membertype']) . "<br>
    <b>User status: </b>" . ucfirst($_SESSION['memberpurpose']) . "</p>";
echo "<button type=\"button\" class=\"button\" onclick=\"location.href='$urlpath/login/logout_page.php'\">Log out</button><br>";
?>

<!-- Information change form -->
<form action="handle_change.php" method="post" align="center" class="login">
    <fieldset class="login">
        <p>
            <!-- First name -->
            <label for="firstname" class="change">Change First Name</label><br>
            <input type="text" name="firstname" class="login" size="20" maxlength="255" <?php echo "placeholder=\"{$_SESSION['firstname']}\"" ?> /><br>
            <!-- Last name -->
            <label for="lastname" class="change">Change Last Name</label><br>
            <input type="text" name="lastname" class="login" size="20" maxlength="255" <?php echo "placeholder=\"{$_SESSION['lastname']}\"" ?> /><br>
            <!-- Username -->
            <label for="username" class="change">Change Public Username</label><br>
            <input type="text" name="username" class="login" size="20" maxlength="31" <?php echo "placeholder=\"{$_SESSION['username']}\"" ?> /><br>
            <!-- Email Address -->
            <label for="email" class="change">Change Email Address</label><br>
            <input type="email" name="email" class="login" size="20" maxlength="255" <?php echo "placeholder=\"{$_SESSION['email']}\"" ?> /><br>
            <!-- Confirm Email -->
            <label for="email" class="change">Confirm Email Address</label><br>
            <input type="email" name="emailconfirm" class="login" size="20" maxlength="255" /><br>
            <!-- Password -->
            <label for="password" class="change">Change Password (Must be greater than 8 characters)</label><br>
            <input type="password" name="password" class="login" size="20" maxlength="255" /><br>
            <!-- Confirm Password -->
            <label for="password" class="change">Confirm Password</label><br>
            <input type="password" name="passwordconfirm" class="login" size="20" maxlength="255" /><br>
            <!-- Member Type -->
            <label for="membertype" class="login">Change member type</label><br>
            <select name="membertype" id="membertype">
                <?php 
                //Add dropdown option for each member type (Order based on current type)
                $membertype = array('individual', 'organization');
                $uctype = ucfirst($_SESSION['membertype']);
                echo "<option value=\"{$_SESSION['membertype']}\" selected disabled hidden>$uctype</option>";
                foreach ($membertype as $type) {
                    $uctype = ucfirst($type);
                    echo "<option value=\"$type\">$uctype</option>";
                }
                ?>
            </select><br>
            <!-- Member Purpose -->
            <label for="memberpurpose" class="login">Change member intention</label><br>
            <select name="memberpurpose" id="memberpurpose">
                <?php 
                //Add dropdown option for each member purpose

                //Avoid admin from changing account type
                 if ($_SESSION['memberpurpose'] != 'admin') {
                    $memberpurpose = array(
                        'volunteer' => 'I want to volunteer',
                        'cause' => 'I need help or support for my cause',
                        'sponsor' => 'I want to provide rewards for volunteers',
                    );
                }
                else {
                    $memberpurpose = array();
                }
                $ucpurpose = ucfirst($_SESSION['memberpurpose']);
                echo "<option value=\"{$_SESSION['memberpurpose']}\" selected disabled hidden>$ucpurpose</option>";
                foreach ($memberpurpose as $purpose => $description) {
                    echo "<option value=\"$purpose\">$description</option>";
                }
                ?>
            </select><br>
        </p>
        <p><input type="submit" name="submit" class="button" value="Change info" /></p>
    </fieldset>
</form>

<!-- Account deletion button -->
<h2>Delete account (Warning: This action is irreversible)</h2><br>
<form action="delete_account.php" method="post" align="center" class="urgent">
    <input type="submit" name="submit" class="button_warn" value="Delete account" />
</form>

<?php
//Include footer
include("$homepath/includes/footer.php");
?>