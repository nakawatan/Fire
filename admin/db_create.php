<?php
session_start();

if (isset($_POST['create'])) {
	include "db/db_con.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

    $name = validate($_POST['name']);
    $eid = validate($_POST['em_code']);
    $dept = validate($_POST['department']);
    $role = validate($_POST['role']);
    $gender = validate($_POST['gender']);
    $contact = validate($_POST['contact']);
    $dob = validate($_POST['date_birth']);
    $joindate = validate($_POST['date_joining']);
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $image = validate($_POST['image']);

	$user_data = 'name='.$name. 'em_code='.$eid. 'department='.$dept. 'role='.$role. 
    'gender='.$gender. 'contact='.$contact. 'date_birth='.$dob. 'date_joining='.$joindate. 'username='.$username. 'email='.$email.
    'password='.$password. 'image='.$image;

       $sql = "INSERT INTO `staff` (`name`, `em_code`, `department`, `role`, `gender`, `contact`, `date_birth`, `date_joining`, `username`, `email`, `password`, `image`) 
               VALUES ('$name', '$eid', '$dept', '$role', '$gender', '$contact', '$dob', '$joindate', '$username', '$email', '$password', '$image')";
       $result = mysqli_query($con, $sql);
       if ($result) {
       	  header("Location: staff.php?success=successfully created");
       }
}