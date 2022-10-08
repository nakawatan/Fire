<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
$id = $_GET['updateid'];
$sql = "SELECT * FROM `staff` WHERE `id`='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$name=$row['name'];
$code=$row['em_code'];
$dept=$row['department'];
$role=$row['role'];
$gder=$row['gender'];
$cont=$row['contact'];
$bd=$row['date_birth'];
$address=$row['address'];
$uname=$row['username'];
$email=$row['email'];
$pass=$row['password'];
$img=$row['image'];


if (isset($_POST['update'])) {
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

    $new_img=$_FILES['image']['name'];
    $old_img=$_POST['image1'];

    if ($new_img != '')
    {
        $update_filename = $_FILES['image']['name'];

    }else{

        $update_filename = $old_img;
    }

    $allowed_exttension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $sql = "UPDATE `staff` SET `id`='$id',`name`='$name',`em_code`='$code',`department`='$dept',
    `role`='$role',`gender`='$gder',`contact`='$cont',`date_birth`='$bd',
    `address`='$address',`username`='$uname',`email`='$email',`password`='$pass', `image`= '$update_filename' WHERE `id`='$id'";

    $result = mysqli_query($con,$sql);
    if ($result){
        if ($_FILES['image']['name'] !=''){
            move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
            unlink("img/".$old_img);
        }
        echo "<script>alert('Record updated successfully!');</script>";
        echo "<script>window.location.href='staff.php'</script>";
    }else{
        echo "<script>alert('Something wrong with the insertion of the records');</script>";
        echo "<script>window.location.href='staff-edit.php'</script>";
    }
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                    <?php } ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary"> Edit Profile Staff</div>
                        </div>
                        <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card">
				                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <img src="<?php echo "img/".$row['image']?>" class="w-100 shadow-1-strong rounded mb-4" >
                                    <h4 class="card-title m-t-10"><?php echo $name; ?></h4>
                                    <h6 class="card-subtitle"></h6>
                                </center>
                            </div>
                            <div> <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo $email; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo $cont; ?></h6> 
                            </div>
                        </div>                                                    
                        </div>
                        <div class="col-md-8">
                            <form class="row" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control form-control-line" placeholder="Employee's Name" minlength="2" required > 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Employee Code </label>
                                    <input type="text" name="em_code" value="<?php echo $code; ?>" class="form-control form-control-line" placeholder="Example: 8820"> 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Department</label>
                                    <select name="department" class="form-control custom-select" required>
                                        <option><?php echo $dept; ?></option>
                                        <option value="Administration">Administration</option>
                                        <option value="Finance, HR, & Admininstration">Finance, HR, & Admininstration</option>
                                        <option value="Research">Research</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Support">Support</option>
                                        <option value="Network Engineering">Network Engineering</option>
                                        <option value="Sales and Marketing">Sales and Marketing</option>
                                        <option value="Helpdesk">Helpdesk</option>
                                        <option value="Project Management">Project Management</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Role </label>
                                    <select name="role" class="form-control custom-select" required>
                                        <option><?php echo $role; ?></option>
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="EMPLOYEE">Employee</option>
                                        <option value="SUPER ADMIN">Super Admin</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Gender </label>
                                    <select name="gender" class="form-control custom-select" required>
                                        <option><?php echo $gder; ?></option>
                                        <option value="MALE">Male</option>
                                        <option value="FEMALE">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Contact Number </label>
                                    <input type="text" name="contact" value="<?php echo $cont; ?>" class="form-control" placeholder="+63" minlength="12" maxlength="15" required> 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Date Of Birth </label>
                                    <input type="date" name="date_birth" class="form-control" value="<?php echo $bd; ?>" placeholder="" required> 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Address </label>
                                    <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder=""> 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Username </label>
                                    <input type="text" name="username" value="<?php echo $uname; ?>" class="form-control form-control-line" placeholder="Username"> 
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Email </label>
                                    <input type="email" id="example-email2" value="<?php echo $email; ?>" name="email" class="form-control" placeholder="email@mail.com" minlength="7" required > 
                                </div>
				                <div class="form-group col-md-12 m-t-10">
                                    <label>Image </label>
                                    <input type="hidden" name="image1" class="form-control" value="<?php echo $img; ?>"> 
                                    <input type="file"  name="image" class="form-control"> 
                                </div>
                                <div class="form-actions col-md-12">
                                    <input type="hidden" name="emid" value="Soy1332">
				                    <button type="submit" class="btn btn-success" name="update"> <i class="fa fa-check"></i>Update</button>
				                    <a href="staff.php"><button type="button" class="btn btn-danger">Cancel</button></a>
				                </div>
				            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php include ('footer.php');?> 