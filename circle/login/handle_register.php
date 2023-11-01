<?php
//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';
$dbpath = '/home/infost490f2305/mysqli_connect/mysqli_connect.php';

//Include header
$pagetitle = 'Registration';
include("$homepath/includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to database
    require($dbpath);
    
    //Check and retrieve login information
    $errors = array();

    //Initialize user info in array
    $user = array();
    
    //Assign each field in an array
    $fields = array(
        'firstname' => 'first name',
        'lastname' => 'last name',
        'username' => 'public username',
        'email' => 'email',
        'password' => 'password',
        'membertype' => 'member type',
        'memberpurpose' => 'role',
    );

    //Check each field is filled
    foreach ($fields as $field => $response) {
        if (!empty($_POST[$field])) {
            $user[$field] = mysqli_real_escape_string($dbc, trim($_POST[$field]));
        }
        else {
            $errors[] = "You forgot to enter your $response";
        }
    }
    
    //Assign each field with confirmation field in array
    $confirm_fields = array(
        'email' => 'emailconfirm',
        'password' => 'passwordconfirm',
    );

    //Check if main and confirmation field match
    if (empty($errors)) {
        foreach ($confirm_fields as $field => $confirm_field) {
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
    }

    //Check if all fields filled in
    if (empty($errors)) {

        //Check if user already exists by querying email or username
        $q = "SELECT email, username FROM users WHERE email = '{$user['email']}' OR username = '{$user['username']}'";
        $r = @mysqli_query($dbc, $q);
        //Store error if user already exists from duplicate username or email
        if (mysqli_num_rows($r) >= 1) {
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                if ($row['email'] == $user['email']) {
                    $errors[] = 'This email is already used. Please log in instead!';
                } elseif ($row['username'] == $user['username']) {
                    $errors[] = 'This username is already used. Please log in instead!';
                }
            }
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
                echo "</p><button type=\"button\" class=\"button\" onclick=\"location.href='login_page.php'\">Log in</button>";
            }
            //Invalid credentials
            else
            {
                $errors[] = 'Issue with registration system. Please contact the Circle team for support.';
            }
        }
    }
    if (!empty($errors)) {
        //List errors
        echo "<p class=\"error\"><strong>The following errors occured:</strong><ul class=\"error\">";
        foreach($errors as $error) {
            echo "<li>$error</li>";
        }
        //Button to redirect user back to registration page
        echo "</p><button type=\"button\" class=\"button\" onclick=\"location.href='register_page.php'\">Try again</button>";
    }
}

//Include footer
include("$homepath/includes/footer.php");
?>