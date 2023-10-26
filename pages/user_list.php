<?php
//Start session
session_start();

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}
//Redirect to admin page if user is not admin
elseif ($_SESSION['memberpurpose'] != 'admin') {
    header("Location: index.php");
    exit();
}

//Include header
$pagetitle = 'User List';
include('includes/header.php');

//Retrieve and print user list from database

//Connect to database
require('~/mysqli_connect/mysqli_connect.php');

//Generate and run query
$q = "SELECT firstname, lastname, username, email, membertype, memberpurpose, regdate FROM users ORDER BY username ASC";
$r = @mysqli_query($dbc, $q);
$num_rows = mysqli_num_rows($r);

//Check if query successful
if ($num_rows > 0) {
    //Print number of results
    echo "<h3>$num_rows registered user(s) found</h3>";
    
    //Print header of table
    echo '<div id = "usertable"><table border="solid" align="center" cellspacing="3" cellpadding="3" width="75%">
        <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Member Type</th>
        <th>Member Purpose</th>
        <th>Registration Date</th>
        </tr>';
    
    //Show results
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        //Format registration date and admin status
        $regdate = date('m/d/Y', strtotime($row['regdate']));
        
        //Print user table
        echo "<tr>
            <td>{$row['username']}</td>
            <td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['membertype']}</td>
            <td>{$row['memberpurpose']}</td>
            <td>$regdate</td>
            </tr>";
    }
    
    echo '</table></div>';
}
//No results found
else {
    echo '<h3 align="center">No users found</h3>';
}

//Close database
mysqli_close($dbc);

//Include footer
include('includes/footer.php')
?>