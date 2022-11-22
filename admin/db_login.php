<?php 
session_start();
include "db/db_con.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['username']);
	$password = validate($_POST['password']);
    $name = validate($_POST['name']);

    if (empty($uname)) {
		header("Location: login.php?error=Email is required");
        exit();
	}else if (empty($password)){
		header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM `user` WHERE username='$uname' AND password= md5('$password')";

        $result =mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] =$row['id'];
            $_SESSION['type'] = "1";
            header("Location: index.php");

        }else{
            header("Location: login.php?error=Incorect Email or Password");
            exit();
        }
    }
	
}else {
    header("Location: login.php");
    exit();
}