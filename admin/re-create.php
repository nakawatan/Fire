<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
if (isset($_POST['create'])) {
    $name=$_POST['name'];
    $pnum=$_POST['permit_num'];
    $etab=$_POST['estab'];
    $gder=$_POST['gender'];
    $cont=$_POST['contact'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $bd=$_POST['bday'];
    
    $sql = "INSERT INTO `record`(`name`, `permit_num`, `estab`, `gender`, `contact`, `address`, `email`, `bday`) 
    VALUES ('$name', '$pnum', '$etab', '$gder', '$cont', '$address', '$email', '$bd')";

    $result = mysqli_query($con,$sql);

    if ($result){
        echo "<script>alert('Successfully added new client!');</script>";
        echo "<script>window.location.href='record.php'</script>";
    }else{
        echo "<script>alert('Something is wrong with the insertion of the register.');</script>";
        echo "<script>window.location.href='re-create.php'</script>";
    }
    
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary"> Client </div>
                        </div>
                        <div class="card-body">
                                <form class="row" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Permit Number</label>
                                        <input type="text" name="permit_num" class="form-control form-control-line" placeholder="Permit Number of Client"  required > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control form-control-line" placeholder="Client Name"  required > 
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
                                        <label>Establishment</label>
                                        <select name="estab" class="form-control custom-select" required>
                                            <option>Select Type of Establishment</option>
                                            <option value="Public">Public</option>
                                            <option value="Private">Private</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Contact Number </label>
                                        <input type="text" name="contact" class="form-control" value="" placeholder="+63"  maxlength="12" required> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Date Of Birth </label>
                                        <input type="date" name="bday" id="example-email2" name="example-email" class="form-control" placeholder="" required> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Address</label>
                                        <input type="text" name="address" id="example-email2" name="example-email" class="form-control" placeholder="Client Address"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Email </label>
                                        <input type="email" id="example-email2" name="email" class="form-control" placeholder="email@mail.com" minlength="7" required > 
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <button type="submit" class="btn btn-primary" name="create"> <i class="fa fa-check"></i>Save</button>
                                        <a href="record.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>
                                </form>
                        </div>
                    </div>
<?php include ('footer.php');?>