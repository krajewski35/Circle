<?php
//Start session
session_start();

//Retrieve form information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to Database
    require('/home/infost490f2305/mysqli_connect/mysqli_connect.php');
    
    //Check and retrieve login information
    $errors = array();
    if (!empty($_POST['email'])) { //Check Email
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));;
    }
    else {
        $errors[] = 'You forgot to enter an email';
    }
    if (!empty($_POST['password'])) { //Check Password
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    }
    else {
        $errors[] = 'You forgot to enter a password';
    }
    
    //Check if all fields filled in (No errors)
    if (empty($errors)) {
        //Query username credentials
        $q = "SELECT firstname, lastname, username, email, membertype, memberpurpose, regdate FROM users WHERE email = '$email' AND password = SHA2('$password', 256)";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
        
        //Check if credentials valid
        if (mysqli_num_rows($r) == 1) {
            //Get user information
            $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
            
            //Store user info into session
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['membertype'] = $user['membertype'];
            $_SESSION['memberpurpose'] = $user['memberpurpose'];
            $_SESSION['regdate'] = $user['regdate'];
            
            //Redirect to user settings on login
            header("Location: ../user/user_settings.php");
            //Quit script
            exit();
        }
        //Invalid credentials
        else
        {
            $errors[] = 'Invalid credentials. Please try again!';
        }
    }
    
    //Include header
    $pagetitle = 'Invalid login';
    include($_SERVER['DOCUMENT_ROOT'] . '/circle/includes/header.php');
    
    //List errors
    echo "<p class=\"error\"><strong>The following errors occured:</strong><ul class=\"error\">";
    foreach($errors as $error) {
        echo "<li>- $error -</li>";
    }
    //Button to redirect user back to login page
    echo "</ul></p><button type=\"button\" onclick=\"location.href='login_page.php'\">Try again</button>";
    
    //Include footer
    include($_SERVER['DOCUMENT_ROOT'] . '/circle/includes/footer.php');
}
?>