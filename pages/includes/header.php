<!DOCTYPE HTML>
<html>
    <head>
        <!-- Basic Header -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo "$pagetitle" ?> - Circle</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/x-icon" href="images/favicon.ico">

        <!-- CSS Design -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
        <link rel= "stylesheet" href="includes/style.css">
    </head>
    <body>
        <div id = "header">
            <span id = "site-name">
                <img src="images/CircleLogoWeb.png" height="105" length="170" class="site-name" align="center">
                <!-- <h1 class="site-name">Circle Volunteering</h1> -->
            </span>
            
            <div id="navigation">
                <ul class="navigation">
                    <!-- All user access -->
                    <li class="navigation"><a href="index.php" class="navigation">Home</a></li>
                    <?php
                    //Logged out user access
                    if (empty($_SESSION['email'])) {
                        //Registration page
                        echo '<li class="navigation"><a href="register_page.php" class="navigation">Register User</a></li>';
                    }
                    //Logged in user access
                    else {
                        //Admin only navigation
                        if ($_SESSION['memberpurpose'] == 'admin') {
                            //User list
                            echo '<li class="navigation"><a href="user_list.php" class="navigation">User List</a></li>';
                        }
                        //User settings
                        echo '<li class="navigation"><a href="user_settings.php" class="navigation">User Settings</a></li>';
                    }
                    ?>
                    <!-- Log in / Log out page -->
                    <li class="navigation"><a href=<?php echo (empty($_SESSION['email'])) ? '"login_page.php"' : '"logout_page.php"' ?> class="navigation"><?php echo (empty($_SESSION['email'])) ? 'Log in' : 'Log out' ?></a></li>
                </ul>
            </div>
        </div>
        <div id = "content">
            <?php echo "<h2>$pagetitle</h2>" ?>