<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
$id = $_GET['updateid'];
$sql = "SELECT * FROM `user` WHERE `id`='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$name=$row['name'];
$status=$row['status'];
$gder=$row['gender'];
$cont=$row['contact'];
$bd=$row['birth'];
$address=$row['address'];
$uname=$row['username'];
$email=$row['email'];
$pass=$row['password'];
$img=$row['image'];


if (isset($_POST['update'])) {
    $name=$_POST['name'];
    $status=$_POST['status'];
    $gder=$_POST['gender'];
    $cont=$_POST['contact'];
    $bd=$_POST['birth'];
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

    $sql = "UPDATE `user` SET `id`='$id',`name`='$name',
    `status`='$status',`gender`='$gder',`contact`='$cont',`birth`='$bd',
    `address`='$address',`username`='$uname',`email`='$email',`password`='$pass', `image`= '$update_filename' WHERE `id`='$id'";

    $result = mysqli_query($con,$sql);
    if ($result){
        if ($_FILES['image']['name'] !=''){
            move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
            unlink("img/".$old_img);
        }
        echo "<script>alert('Successfully updated user details!');</script>";
        echo "<script>window.location.href='user.php'</script>";
    }else{
        echo "<script>alert('Something is wrong with the insertion of the register.');</script>";
        echo "<script>window.location.href='user-edit.php'</script>";
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
                          <div class="pull-left m-0 font-weight-bold text-primary"> Add New User</div>
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
                                    <img src="<?php echo "img/".$row['image']?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $name; ?></h4>
                                    <h6 class="card-subtitle"></h6>
                                </center>
                            </div>
                            <div> <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo $email; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo $cont; ?></h6> 
                                <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <a class="btn btn-circle btn-secondary" href="" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="btn btn-circle btn-secondary" href="" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a class="btn btn-circle btn-secondary" href="" target="_blank"><i class="fa fa-skype"></i></a>
                                <a class="btn btn-circle btn-secondary" href="" target="_blank"><i class="fa fa-google"></i></a>
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
                                    <label>Status </label>
                                    <select name="status" class="form-control custom-select" required>
                                        <option><?php echo $status; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
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
                                    <input type="date" name="birth" class="form-control" value="<?php echo $bd; ?>" placeholder="" required> 
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
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Password </label>
                                    <input type="password" name="password" id="password" value="<?php echo $pass; ?>" class="form-control" placeholder="**********"> 
                                </div>
				                <div class="form-group col-md-12 m-t-10">
                                    <img src="<?php echo "img/".$row['image']?>" class="img-circle" width="150" />
                                    <label>Image </label>
                                    <input type="hidden" name="image1" class="form-control" value="<?php echo $img; ?>"> 
                                    <input type="file"  name="image" class="form-control"> 
                                </div>
                                <div class="form-actions col-md-12">
                                    <input type="hidden" name="emid" value="Soy1332">
				                    <button type="submit" class="btn btn-success" name="update"> <i class="fa fa-check"></i>Update</button>
				                    <a href="user.php"><button type="button" class="btn btn-danger">Cancel</button></a>
				                </div>
				            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php include ('footer.php');?>