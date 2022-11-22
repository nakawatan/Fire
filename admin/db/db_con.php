<?php  

$sname = "localhost";
$uname = "jmsemira";
$password = "password";

$db_name = "bfp";

$con = mysqli_connect($sname, $uname, $password, $db_name);

if (!$con) {
	echo "Connection failed!";
}