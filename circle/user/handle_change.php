<?php
//Start session
session_start();

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

    //Check if field is filled and sanitize input if so
    foreach ($fields as $field => $response) {
        if (!empty($_POST[$field])) {
            $user[$field] = mysqli_real_escape_string($dbc, trim($_POST[$field]));
        }
    }
    
    //Assign each field with confirmation field in array
    $confirm_fields = array(
        'email' => 'emailconfirm',
        'password' => 'passwordconfirm',
    );

    //Check if main and confirmation field match if both are filled
    foreach ($confirm_fields as $field => $confirm_field) {
        //Check if both fields are not empty
        if (!empty($_POST[$field]) && !empty($_POST[$confirm_field])) {
            //Check if both fields match
            if ($_POST[$field] != $_POST[$confirm_field]) {
                $errors[] = 'Your ' . $field . 's do not match';
            }
        }
    }
    //Check if conformation field is needed for email change
    if (empty($_POST['email']) xor empty($_POST['emailconfirm'])) {
        $errors[] = 'Your emails do not match';
    //Check if conformation field is needed for password change
    } elseif (empty($_POST['password']) xor empty($_POST['passwordconfirm'])) {
        $errors[] = 'Your passwords do not match';
    }

    //Check if no issues with changing info
    if (empty($errors)) {

        //Check if user already exists by email or username
        $q = "SELECT email, username FROM users WHERE email = '{$user['email']}' OR username = '{$user['username']}'";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) >= 1) {
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                if ($row['email'] == $user['email']) {
                    $errors[] = 'This email is already used. Please enter a different email.';
                } elseif ($row['username'] == $user['username']) {
                    $errors[] = 'This username is already used. Please enter a different username.';
                }
            }
        }

        //Add user to database
        else {
            //Get email seperate for databse reference in case it changes
            $prevemail = $_SESSION['email'];

            //Build update query for each field filled
            $q = "UPDATE users SET ";
            foreach ($fields as $field => $response) {
                //Add each updated field to update query
                if (!empty($_POST[$field])) {
                    if ($field != 'password') {
                        $q .= "$field = '{$user[$field]}', ";
                        $_SESSION[$field] = $user[$field];
                    }
                    //Password is updated seperately
                    else {
                        $q .= "$field = SHA2('{$user[$field]}', 256), ";
                    }
                }
            }
            $q = substr($q, 0, strlen($q)-2); //Remove extra end comma
            $q .= " WHERE email='$prevemail'";

            //echo "Query: $q<br>"; //Uncomment for DEBUGGING

            //Run update query
            $r = @mysqli_query($dbc, $q);
            mysqli_close($dbc);
            
            //Check if credentials valid
            if ($r) {
                echo "User information updated";
                echo "</p><button type=\"button\" onclick=\"location.href='user_settings.php'\">Back to user settings</button>";
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
        echo "</p><button type=\"button\" onclick=\"location.href='user_settings.php'\">Go back</button>";
    }
}

//Include footer
include("$homepath/includes/footer.php");
?>