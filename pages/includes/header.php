<!DOCTYPE HTML>
<html>
    <head>
        <!-- Basic Header -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo "$pagetitle" ?> - Circle</title>
        <link type="text/css" rel="stylesheet" href="style.css" />

        <!-- Links -->
        <link rel="icon" href="images/favicon.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
        <link rel= "stylesheet" href="includes/style.css">
        <link rel="icon" type="image/x-icon" href="cir_favicon.png">
    </head>
    <body>
        <div id = "header">
            <span id = "site-name">
                <img src="images/CircleLogoWeb.png" width="200" height="105" class="site-name">
                <h1 class="site-name">Circle Volunteering</h1>
            </span>
            
            <div id="navigation">
                <ul class="navigation">
                    <!-- All user access -->
                    <li class="navigation"><a href="index.php" class="navigation">Home</a></li>
                    <?php
                    //Logged in user access
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
                    //Logged out user access
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