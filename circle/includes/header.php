<!DOCTYPE HTML>
<html>
    <head>
        <!-- Define homepath with PHP -->
        <?php $homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle' ?>

        <!-- Basic Header -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo "$pagetitle" ?> - Circle</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/x-icon" href=<?php echo "\"$homepath/images/favicon.ico\"" ?> >

        <!-- CSS Design -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
        <link rel= "stylesheet" href=<?php echo "\"$homepath/includes/style.css\"" ?> >
    </head>
    <body>
        <div id = "header">
            <span id = "site-name">
                <img src=<?php echo "\"$homepath/images/CircleLogoWeb.png\"" ?> height="105" length="170" class="site-name">
            </span>
            
            <div id="navigation">
                <ul class="navigation">
                    <?php
                    //All user access
                    echo "<li class=\"navigation\"><a href=\"$homepath/index.php\" class=\"navigation\">Home</a></li>";
                    //CONTINUE HOMEPATH REPLACEMENT
                    //Logged out user access
                    if (empty($_SESSION['email'])) {
                        //Registration page
                        echo '<li class="navigation"><a href="' . $_SERVER['HTTP_HOST'] . '/circle/login/register_page.php" class="navigation">Register User</a></li>';
                    }

                    //Logged in user access
                    else {
                        //Admin only navigation
                        if ($_SESSION['memberpurpose'] == 'admin') {
                            //User list
                            echo '<li class="navigation"><a href="' . $_SERVER['HTTP_HOST'] . '/circle/user/admin/user_list.php" class="navigation">User List</a></li>';
                        }
                        //User settings
                        echo '<li class="navigation"><a href="' . $_SERVER['HTTP_HOST'] . '/circle/user_settings.php" class="navigation">User Settings</a></li>';
                    }
                    ?>

                    <!-- Log in / Log out page -->
                    <li class="navigation"><a href=<?php echo (empty($_SESSION['email'])) ? '"' . $_SERVER['HTTP_HOST'] . '/circle/login/login_page.php"' : '"' . $_SERVER['HTTP_HOST'] . '/circle/login/logout_page.php"' ?> class="navigation"><?php echo (empty($_SESSION['email'])) ? 'Log in' : 'Log out' ?></a></li>
                </ul>
            </div>
        </div>
        <div id = "content">
            <?php echo "<h2>$pagetitle</h2>" ?>