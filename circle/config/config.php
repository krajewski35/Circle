<?php
/*
//Main path for document root (Use for PHP include())
define('HOME_PATH', $_SERVER['DOCUMENT_ROOT'] . '/circle');
//Main path for URL root (Use for images, links, and PHP header() redirects)
define('URL_PATH', $_SERVER['HTTP_POST'] . '/circle');
//Database initialization path (Outside of public_html directory)
define('DB_PATH', '/home/infost490f2305/mysqli_connect/mysqli_connect.php');
*/

$homepath = $_SERVER['DOCUMENT_ROOT'] . '/circle';
$urlpath = $_SERVER['HTTP_POST'] . '/circle';
$dbpath = '/home/infost490f2305/mysqli_connect/mysqli_connect.php';
?>