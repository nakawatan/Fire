<?php 
session_start();
include "db/db_con.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
	$password = validate($_POST['password']);

    if (empty($email)) {
		header("Location: login.php?error=Email is required");
        exit();
	}else if (empty($password)){
		header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM `staff` WHERE email='$email' AND password='$password'";

        $result =mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
                $_SESSION['email'] = $email;
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