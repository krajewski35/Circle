<?php
//Include header
$pagetitle = 'Registration';
include('includes/header.php');

//Check if field specified entered in POST
function checkform($field, $response, $errors, $dbc) {
    if (!empty($_POST[$field])) {
        $field_return = mysqli_real_escape_string($dbc, trim($_POST[$field]));
    } else {
        $errors[] = "You forgot to enter your $response";
        $field_return = '';
    }
    return $field_return;
}

//Check if field and confirmation field match
function verifymatch($field, $confirm_field, $errors) {
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to database
    require('/home/infost490f2305/mysqli_connect/mysqli_connect.php');
    
    //Check and retrieve login information
    $errors = array();
    
    //Assign each field in an array
    $fields = array(
        'firstname' => 'first name',
        'lastname' => 'last name',
        'username' => 'public username',
        'email' => 'email',
        'password' => 'password',
        'membertype' => 'member type',
        'memberpurpose' => 'intended use',
    );

    //Initialize user info in array
    $user = array();

    //Check fields for correct input
    foreach ($fields as $field => $response) {
        $user[$field] = checkform($field, $response, $errors, $dbc);
        echo "$field: $user[$field]"; //DEBUGGING
    }

    //Assign each field with confirmation field in an array
    $confirm_fields = array(
        array('email', 'emailconfirm'),
        array('password', 'passwordconfirm'),
    );

    //Check if main and confirmation field match
    foreach ($confirm_fields as $confirm_field) {
        verifymatch($confirm_field[0], $confirm_field[1], $errors);
    }

    //Check if all fields filled in
    if (empty($errors)) {

        //Check if user already exists
        $q = "SELECT email FROM users WHERE email = '{$user['email']}'";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) == 1) {
            $errors[] = 'This email is already used. Please try again!';
        }

        //Add user to database
        else {
            //Run insert query
            $q = "INSERT INTO users (firstname, lastname, username, email, password, membertype, memberpurpose, regdate) VALUES ('{$_POST['firstname']}', '{$user['lastname']}', '{$user['username']}', '{$user['email']}', SHA2('{$user['password']}', 256), '{$user['membertype']}', '{$user['memberpurpose']}', NOW())";
            $r = @mysqli_query($dbc, $q);
            mysqli_close($dbc);
            
            //Check if credentials valid
            if ($r) {
                echo "Welcome to Circle {$user['firstname']} {$user['lastname']}! You can now log in.";
                echo "</p><button type=\"button\" onclick=\"location.href='login_page.php'\">Log in</button>";
            }
            //Invalid credentials
            else
            {
                $errors[] = 'Issue with registration system. Please contact the Circle team for support.';
            }
        }
    }
    if (!empty($errors)) {
        //Redirect back to registration page with errors
        echo "<p class=\"error\"><strong>The following errors occured:</strong><ul class=\"error\">";
        foreach($errors as $error) {
            echo "<li>$error</li>";
        }
        //Redirect user
        echo "</p><button type=\"button\" onclick=\"location.href='register.php'\">Try again</button>";
    }
}

//Include footer
include('includes/footer.php');
?>