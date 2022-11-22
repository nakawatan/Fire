<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sname = "localhost";
$uname = "jmsemira";
$password = "password";

$db_name = "bfp";

$con = mysqli_connect($sname, $uname, $password, $db_name);
if (!$con) {
	echo "Connection failed!";
	die("!");
}