<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}
//Redirect to admin page if user is admin
elseif ($_SESSION['member_type'] == 'admin') {
    header("Location: admin_page.php");
    exit();
}

//Include header
$pagetitle = 'User Settings';
include('includes/header.php');

//Display content
echo "<h3>{$_SESSION['firstname']} {$_SESSION['lastname']}</h3>";
echo "<h4>{$_SESSION['username']}</h4>";
echo "<p class=\"userdetails\">" . 
    "<b>Email address: </b>" . $_SESSION['email'] . "<br>
    <b>User type: </b>" . ucfirst($_SESSION['member_type']) . "<br>
    <b>User status: </b>" . ucfirst($_SESSION['member_purpose']) . "</p>";
echo "<button type=\"button\" onclick=\"location.href='logout_page.php'\">Log out</button>";
?>

<!-- Information change form -->
<form action="handle_change.php" method="post" align="center" class="change">
    <fieldset class="change">
        <p>
            <!-- First name -->
            <label for="firstname" class="change">Change First Name</label><br>
            <input type="text" name="firstname" class="change" size="20" maxlength="255" value=<?php echo "\"{$_SESSION['firstname']}\""; ?> /><br>
            <!-- Last name -->
            <label for="lastname" class="change">Change Last Name</label><br>
            <input type="text" name="lastname" class="change" size="20" maxlength="255" /><br>
            <!-- Username -->
            <label for="username" class="change">Change Public Username</label><br>
            <input type="text" name="username" class="change" size="20" maxlength="31" /><br>
            <!-- Email Address -->
            <label for="email" class="change">Change Email Address</label><br>
            <input type="email" name="email" class="change" size="20" maxlength="255" /><br>
            <!-- Confirm Email -->
            <label for="email" class="change">Confirm Email Address</label><br>
            <input type="email" name="emailconfirm" class="change" size="20" maxlength="255" /><br>
            <!-- Password -->
            <label for="password" class="change">Change Password (Must be greater than 8 characters)</label><br>
            <input type="password" name="password" class="change" size="20" maxlength="255" /><br>
            <!-- Confirm Password -->
            <label for="password" class="change">Confirm Password</label><br>
            <input type="password" name="passwordconfirm" class="change" size="20" maxlength="255" /><br>
            <!-- Member Type -->
            <label for="membertype" class="change">Change member type</label><br>
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
            <label for="memberpurpose" class="change">Change member intention</label><br>
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
        <p><input type="submit" name="submit" value="Change info" /></p>
    </fieldset>
</form>

<?php
//Include footer
include('includes/footer.php')
?>