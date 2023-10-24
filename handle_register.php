<?php
//Include header
$pagetitle = 'Registration';
include('includes/header.php');

//Check if field specified entered in POST
function checkform($field, $response, $dbc) {
    if (!empty($_POST[$field])) {
        $field_return = mysqli_real_escape_string($dbc, trim($_POST[$field]));
    } else {
        $errors[] = "You forgot to enter your $response";
        $field_return = $field;
    }
    return $field_return;
}

//Check if field and confirmation field match
function verifymatch($field, $confirm_field) {
    //Check if both fields are not empty
    if (!empty($_POST[$field]) && !empty($_POST[$confirm_field])) {
        //Check if both fields match
        if ($_POST[$field] != $_POST[$confirm_field]) {
            $errors[] = 'Your ' . $field . 's do not match';
        }
    //Check if confirmation field is empty
    } elseif(empty($_POST[$confirm_field])) {
        $errors[] = 'Your ' . $field . 's do not match';
    }

}

if ($SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to database
    require('/home/infost490f2305/mysqli_connect/mysqli_connect.php');

    //Check and retrieve login information
    $errors = array();
    
    //Assign each field in an array
    $fields = array(
        'firstname' => array('firstname', 'first name'),
        'lastname' => array('lastname', 'last name'),
        'username' => array('username', 'public username'),
        'email' => array('email', 'email'),
        'password' => array('password', 'password'),
    );

    //Check fields for correct input
    foreach ($fields as $field) {
        $fields[$field] = checkform($field[0], $field[1], $dbc);
    }

    //Assign each field with confirmation field in an array
    $confirm_fields = array(
        array('email', 'emailconfirm'),
        array('password', 'passwordconfirm'),
    );

    //Check if main and confirmation field match
    foreach ($confirm_fields as $confirm_field) {
        verifymatch($confirm_field[0], $confirm_field[1]);
    }

    if (empty($_POST('membertype'))) {
        $errors[] = "You forgot to enter your member type";
    }

    if (empty($_POST('memberpurpose'))) {
        $errors[] = "You forgot to enter your purpose";
    }

    //Check if all fields filled in
    if (empty($errors)) {

        //Check if user already exists
        $q = "SELECT email FROM users WHERE email = '{$_POST['email']}'";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) == 1) {
            $errors[] = 'This email is already used. Please try again!';
        }

        //Add user to database
        else {
            //Run insert query
            $q = "INSERT INTO users (firstname, lastname, username, email, password, membertype, memberpurpose, regdate) VALUES ('{$_POST['firstname']}', '{$_POST['lastname']}', '{$_POST['username']}', '{$_POST['email']}', SHA2('{$_POST['password']}', 256), '{$_POST['membertype']}', '{$_POST['memberpurpose']}', NOW())";
            $r = @mysqli_query($dbc, $q);
            mysqli_close($dbc);
            
            //Check if credentials valid
            if ($r) {
                echo "Welcome to Circle {$_POST['firstname']} {$_POST['lastname']}! You can now log in.";
                echo "</p><button type=\"button\" onclick=\"location.href='login_page.php'\">Log in</button>";
            }
            //Invalid credentials
            else
            {
                $errors[] = 'Issue with registration system. Please contact the Circle team for support.';
            }
        }
        if (!empty($errors)) {
            //Redirect back to registration page with errors
            echo "<p class=\"error\"><strong>The following errors occured:</strong><ul class=\"error\">";
            foreach($errors as $error) {
                echo "<li>- $error -</li>";
            }
            //Redirect user
            echo "</p><button type=\"button\" onclick=\"location.href='register.php'\">Try again</button>";
        }
    }
}

//Include footer
include('includes/footer.php');
?>