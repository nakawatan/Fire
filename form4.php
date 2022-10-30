<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
if (isset($_POST['create'])) {
    $nowner=$_POST['nowner'];
    $esname=$_POST['esname'];
    $address=$_POST['address'];
    $autho=$_POST['autho'];
    $bnature=$_POST['bnature'];
    $area=$_POST['area'];
    $contact=$_POST['contact'];
    
    $sql = "INSERT INTO `record`(`nowner`, `esname`, `autho`, `address`, `bnature`, `area`, `contact`) 
    VALUES  ('$nowner', '$esname', '$address', '$autho', '$bnature', '$area', '$contact')";

    $result = mysqli_query($con,$sql);

    if ($result){
        echo "<script>alert('Successfully added new client!');</script>";
        echo "<script>window.location.href='request.php'</script>";
    }else{
        echo "<script>alert('Something is wrong with the insertion of the register.');</script>";
        echo "<script>window.location.href='form2.php'</script>";
    }
    
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-right m-0 font-weight-bold text-danger" style="text-align: center;">
                          ATTACHED DOCUMENTARY REQUIREMENTS</div>
                          
                        </div>
                        <!-- Content Row -->
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-primary" href="form2.php">FSIC FOR CERTIFICATE OF OCCUPANCY</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-warning" href="form3.php">FOR NEW BUSINESS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-info m-0 font-weight-bold text-white" href="form4.php">FOR RENEWAL  OF BUSINESS</a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">COPY OF FIRE INSURANCE (IF NECESSARY)</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">ONE (1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF  NECESSARY)</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS (IF REQUIRED)</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success" name="create">Submit</button>
                                    <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-default">Clear</button>
                                    <a href="form.php"><button type="button" class="float-right d-none d-sm-inline-block btn btn-sm btn-danger">
                                    Back</button></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
<?php include ('footer.php');?>