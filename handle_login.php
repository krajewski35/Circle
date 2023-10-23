<?php
//Start session
session_start();

//Retrieve form information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Connect to Database
    require('mysqli_connect.php');
    
    //Check and retrieve login information
    $errors = array();
    if (!empty($_POST['email'])) { //Check Email
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));;
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
    
    //Check if all fields filled in
    if (empty($errors)) {
        //Query username credentials
        $q = "SELECT firstname, lastname, email, is_admin, regdate FROM users WHERE email = '$email' AND password = SHA2('$password', 256)";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
        
        //Check if credentials valid
        if (mysqli_num_rows($r) == 1) {
            //Get user information
            $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
            
            //Set user session info
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            //Redirect to admin page if user is admin
            if ($user['is_admin'] == true) {
                //Redirect user
                header("Location: admin_page.php");
                //Quit script
                exit();
            }
            //Redirect to user page if user is not admin
            else {
                //Redirect user
                header("Location: user_page.php");
                //Quit script
                exit();
            }
        }
        //Invalid credentials
        else
        {
            $errors[] = 'Invalid credentials';
        }
    }
    
    //Include header
    $pagetitle = 'Invalid login';
    include('includes/header.php');
    
    //Redirect back to login page with errors
    echo "<p class=\"error\"><strong>The following errors occured:</strong><ul class=\"error\">";
    foreach($errors as $error) {
        echo "<li>- $error -</li>";
    }
    //Redirect user
    echo "</ul></p><button type=\"button\" onclick=\"location.href='login_page.php'\">Try again</button>";
    
    //Include footer
    include('includes/footer.php');
}
?>