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

    if (empty($uname)) {
		header("Location: login.php?error=Email is required");
        exit();
	}else if (empty($password)){
		header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM `user` WHERE username='$uname' AND password='$password'";

        $result =mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $password) {
                $_SESSION['username'] = $uname;
                $_SESSION['password'] = $password;
				header("Location: index.php");
                exit();
              
            }else{
            header("Location: login.php?error=Incorect Email or Password");
            exit();
            }

        }else{
            header("Location: login.php?error=Incorect Email or Password");
            exit();
        }
    }
	
}else {
    header("Location: login.php");
    exit();
}