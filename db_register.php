<?php 
session_start();
include "admin/db/db_con.php";

if (isset($_POST['name']) && isset($_POST['password']) 
&& isset($_POST['uname']) && isset($_POST['repassword'])
&& isset($_POST['email'])) {

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['name']);
	$password = validate($_POST['uname']);

    $uname = validate($_POST['email']);
	$password = validate($_POST['password']);

    $uname = validate($_POST['repassword']);

    $user_data = 'uname='. $uname. 'name'. $name;

    if (empty($name)) {
		header("Location: register.php?error=Name is required&$user_data");
        exit();
	}else if (empty($uname)){
		header("Location: register.php?error=User Name is required&$user_data");
        exit();
    }else if (empty($email)){
		header("Location: register.php?error=Email Address is required&$user_data");
        exit();
    }else if (empty($password)){
		header("Location: register.php?error=Password is required&$user_data");
        exit();
    }else if (empty($repassword)){
		header("Location: register.php?error=Repeat Password is required&$user_data");
        exit();
    }else{
        $password = md5($password);

	    $sql = "SELECT * FROM client WHERE uname='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO client (name, uname, emaail, password) VALUES('$name', '$uname', '$email' , '$password')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
    }
	
}else {
    header("Location: register.php");
    exit();
}