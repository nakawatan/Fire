<?php
    require_once 'db/db_con.php';
    if(isset($_POST['update'])){

        $id = intval($_GET['id']);
        $name=$_POST['name'];
        $eid=$_POST['em_code'];
        $dept=$_POST['department'];
        $role=$_POST['role'];
        $gender=$_POST['gender'];
        $contact=$_POST['contact'];
        $dob=$_POST['date_birth'];
        $joindate=$_POST['date_joining'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
          
        $sql ="UPDATE staff SET 'name=' $name, 'em_code='$eid, 'department='$dept, 'role='$role,
        'gender='$gender, 'contact='$contact, 'date_birth='$dob, 'date_joining='$joindate, 'username='$username, 'email='$email,
        'password='$password WHERE id= $id";

        $query = $dbh->prepare($sql);

        $query->bindParam('name',$name,PDO::PARAM_STR);
        $query->bindParam('em_code',$eid,PDO::PARAM_STR);
        $query->bindParam('department',$dept,PDO::PARAM_STR);
        $query->bindParam('role',$role,PDO::PARAM_STR);
        $query->bindParam('gender',$gender,PDO::PARAM_STR);
        $query->bindParam('contact',$contact,PDO::PARAM_STR);
        $query->bindParam('date_birth',$dob,PDO::PARAM_STR);
        $query->bindParam('date_joining',$joindate,PDO::PARAM_STR);
        $query->bindParam('username',$username,PDO::PARAM_STR);
        $query->bindParam('email',$email,PDO::PARAM_STR);
        $query->bindParam('password',$password,PDO::PARAM_STR);

        $query->execute();
        echo "<script>alert('Record updated successfully!');</script>";
        echo "<script>window.location.href='dashboard.php'</script>";

    }
?>
