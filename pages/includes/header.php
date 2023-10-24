<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo "$pagetitle" ?> - Circle</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <link rel="icon" href="images/favicon.ico">
    </head>
    <body>
        <div id = "header">
            <span id = "site-name">
                <!-- <img src="images/logo.png" width="120" height="80" class="site-name"> ADD LOGO-->
                <h1 class="site-name">Circle Volunteering</h1>
            </span>
            
            <div id="navigation">
                <ul class="navigation">
                    <!-- General navigation -->
                    <li class="navigation"><a href="index.php" class="navigation">Build PC</a></li>
                    <?php
                    //Logged in user navigation
                    if (!empty($_SESSION['email'])) {
                        /*
                        //Search page on login
                        echo '<li class="navigation"><a href="search_page.php" class="navigation">Search Products</a></li>';
                        //Admin only navigation
                        if ($_SESSION['is_admin']) {
                            echo '<li class="navigation"><a href="admin_page.php" class="navigation">Admin Page</a></li>';
                            echo '<li class="navigation"><a href="addproduct_page.php" class="navigation">Add Product</a></li>';
                            echo '<li class="navigation"><a href="vieworders_page.php" class="navigation">View Orders</a></li>';
                        }
                        //User only navigation
                        else {
                            echo '<li class="navigation"><a href="user_page.php" class="navigation">User Page</a></li>';
                        }
                        //User & Admin navigation
                        echo '<li class="navigation"><a href="cart_page.php" class="navigation">Cart</a></li>';
                        */
                        
                    }
                    //Logged out user navigation
                    else {
                        echo '<li class="navigation"><a href="register_page.php" class="navigation">Register User</a></li>';
                    }
                    ?>
                    <!-- Log in/out page -->
                    <li class="navigation"><a href=<?php echo (empty($_SESSION['email'])) ? '"login_page.php"' : '"logout_page.php"' ?> class="navigation"><?php echo (empty($_SESSION['email'])) ? 'Log in' : 'Log out' ?></a></li> 
                </ul>
            </div>
        </div>
        <div id = "content">
            <?php echo "<h2>$pagetitle</h2>" ?>