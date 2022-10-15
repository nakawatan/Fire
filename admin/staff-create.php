<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
if (isset($_POST['create'])) {
    $name=$_POST['name'];
    $code=$_POST['em_code'];
    $dept=$_POST['department'];
    $role=$_POST['role'];
    $gder=$_POST['gender'];
    $cont=$_POST['contact'];
    $bd=$_POST['date_birth'];
    $address=$_POST['address'];
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $img=$_FILES['image']['name'];

    $allowed_exttension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    $sql = "INSERT INTO staff(name, em_code, department, role, gender, contact, date_birth, address, username, email, password, image) 
    VALUES ('$name', '$code', '$dept', '$role', '$gder', '$cont', '$bd', '$address', '$uname', '$email', '$pass', '$img')";

    $result = mysqli_query($con,$sql);

    if ($result){
        move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
        echo "<script>alert('Record inserted successfully');</script>";
        echo "<script>window.location.href='staff.php'</script>";
    }else{
        echo "<script>alert('Something wrong with the insertion of the records');</script>";
        echo "<script>window.location.href='staff-create.php'</script>";
    }
    
}
?>
         <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary"> Add New Staff</div>
                        </div>
                        <div class="card-body">
                                <form class="row" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control form-control-line" placeholder="Employee's Name" minlength="2" required > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Employee Code </label>
                                        <input type="text" name="em_code" class="form-control form-control-line" placeholder="Example: 8820"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Department</label>
                                        <select name="department" value="" class="form-control custom-select" required>
                                            <option>Select Department</option>
                                            <option value="2">Administration</option>
                                            <option value="3">Finance, HR, & Admininstration</option>
                                            <option value="4">Research</option>
                                            <option value="5">Information Technology</option>
                                            <option value="6">Support</option>
                                            <option value="7">Network Engineering</option>
                                            <option value="8">Sales and Marketing</option>
                                            <option value="9">Helpdesk</option>
                                            <option value="10">Project Management</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Role </label>
                                        <select name="role" class="form-control custom-select" required>
                                            <option>Select Role</option>
                                            <option value="ADMIN">ADMIN</option>
                                            <option value="EMPLOYEE">Employee</option>
                                            <option value="SUPER ADMIN">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Gender </label>
                                        <select name="gender" class="form-control custom-select" required>
                                            <option>Select Gender</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Contact Number </label>
                                        <input type="text" name="contact" class="form-control" value="" placeholder="+63" minlength="12" maxlength="15" required> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Date Of Birth </label>
                                        <input type="date" name="date_birth" id="example-email2" name="example-email" class="form-control" placeholder="" required> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Address</label>
                                        <input type="text" name="address" id="example-email2" name="example-email" class="form-control" placeholder=""> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Username </label>
                                        <input type="text" name="username" class="form-control form-control-line" value="" placeholder="Username"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Email </label>
                                        <input type="email" id="example-email2" name="email" class="form-control" placeholder="email@mail.com" minlength="7" required > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Image </label>
                                        <input type="file" name="image" class="form-control" value=""> 
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <button type="submit" class="btn btn-primary" name="create"> <i class="fa fa-check"></i>Save</button>
                                        <a href="staff.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>
                                </form>
                        </div>
                    </div>                
<?php include ('footer.php');?>