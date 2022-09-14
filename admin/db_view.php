<?php  session_start();

include "db/db_con.php";

$sql = "SELECT * FROM staff ORDER BY id DESC";
$result = mysqli_query($con, $sql);