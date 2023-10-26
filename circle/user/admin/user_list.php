<?php
//Start session
session_start();

//Define homepaths
$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';
$dbpath = '/home/infost490f2305/mysqli_connect/mysqli_connect.php';

//Redirect to login page if accessed directly
if (empty($_SESSION['email'])) {
    header("Location: $urlpath/login/login_page.php");
    exit();
}
//Redirect to homepage if user is not admin
elseif ($_SESSION['memberpurpose'] != 'admin') {
    header("Location: $urlpath/index.php");
    exit();
}

//Include header
$pagetitle = 'User List';
include("$homepath/includes/header.php");

//Retrieve and print user list from database

//Connect to database
require($dbpath);

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
    $user_list = array();
    $i = 0;
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        //Format registration date and admin status
        $regdate = date('m/d/Y', strtotime($row['regdate']));

        //Gather list of emails and admin status
        $user_list[$i]['email'] = $row['email'];
        $user_list[$i]['admin'] = ($row['memberpurpose'] == 'admin');
        
        //Print user table
        $ucmembertype = ucfirst($row['membertype']);
        $ucmemberpurpose = ucfirst($row['memberpurpose']);
        echo "<tr>
            <td>{$row['username']}</td>
            <td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['email']}</td>
            <td>$ucmembertype</td>
            <td>$ucmemberpurpose</td>
            <td>$regdate</td>
            </tr>";
        ++$i;
    }
    echo '</table></div>';

    //Display list of actions for emails
    //Print header of table
    echo '<div id = "usertable"><table border="solid" align="center" cellspacing="3" cellpadding="3" width="75%">
        <tr>
        <th>User</th>
        <th>Make/Remove Admin</th>
        <th>Delete Account</th>
        </tr>';
    
    //Show user emails and admin change and delete account actions for each account
    foreach ($user_list as $user) {
        $admin_action = $user['admin'] ? 'Remove Admin' : 'Make Admin';
        echo "<tr><td>{$user['email']}</td>";
        //Print actions if not the signed in user
        if ($user['email'] != $_SESSION['email']) {
            echo "<td>
                    <form action=\"admin_change.php\" method=\"post\">
                        <input type=\"hidden\" name=\"email\" value=\"{$user['email']}\">
                        <input type=\"hidden\" name=\"admin\" value=\"{$user['admin']}\">
                        <input type=\"submit\" name=\"submit\" value=\"$admin_action\" />
                    </form>
                </td>
                <td>
                    <form action=\"admin_delete.php\" method=\"post\">
                        <input type=\"hidden\" name=\"email\" value=\"{$user['email']}\">
                        <input type=\"submit\" name=\"submit\" value=\"Delete Account\" />
                    </form>
                </td></tr>";
        }
        //Do not print action buttons if the signed in user
        else {
            echo "<td>Cannot change</td>
                <td>Cannot delete</td></tr>";
        }
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
include("$homepath/includes/footer.php");
?>