<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
                                        
$sql = "SELECT * FROM `record` ORDER BY id DESC";
$result = mysqli_query($con,$sql);
$i=1;
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appnum=$row['appnum'];
        $nowner=$row['nowner'];
        $esname=$row['esname'];
        $address=$row['address'];
        $autho=$row['autho'];
        $bnature=$row['bnature'];
        $area=$row['area'];
        $contact=$row['contact'];
        $date=$row['date'];
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
   
                    <div class="card shadow mb-4" style="font-size: 15px;">
                        <div class="card-header py-3">
                            <div class="pull-left m-0 font-weight-bold text-primary" style="text-align: center;">FIRE SAFETY INSPECTION CERTIFICATE APPLICATION FORM OF CLIENT</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row">Application Number:</th>
                                        <td><?php echo $row['appnum']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name of Owner:</th>
                                        <td><?php echo $row['nowner']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Establishment Name:</th>
                                        <td><?php echo $row['esname']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Exact Address:</th>
                                        <td><?php echo $row['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Authorized Representative:</th>
                                        <td><?php echo $row['autho']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Business Nature:</th>
                                        <td><?php echo $row['bnature']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Floor Area(M2):</th>
                                        <td><?php echo $row['area']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact Number:</th>
                                        <td><?php echo $row['contact']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date:</th>
                                        <td><?php echo date("F d, Y",strtotime($date)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow mb-4" style="font-size: 15px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">DOCUMENTARY REQUIREMENTS </h6>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-primary" href="re-view.php">FSIC FOR CERTIFICATE OF OCCUPANCY</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-warning m-0 font-weight-bold text-white" href="re-view2.php">FOR NEW BUSINESS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-info" href="re-view3.php">FOR RENEWAL  OF BUSINESS</a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">ASSESSMENT OF BUSINESS PERMIT FEE/ TAX ASSESSMENT BILL FROM BPLO</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANTIAL CHANGES MADE ON BUILDING/ESTABLISHMENT</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <h4 class="small font-weight-bold">COPY OF FIRE INSURANCE (IF NECESSARY)</h4>
                                    <input type="file" name="image" class="form-control" value="" style="font-size: 13px;">
                                </div>
                                <div class="form-group col-md-20 m-t-20">
                                    <a href="request.php"><button type="button" class="float-right d-none d-sm-inline-block btn btn-sm btn-danger">
                                    Back</button></a>
                                </div>
                            </div>
                        </div>
                            <?php
                                }
                                }
                                            
                            ?>
                             
<?php include ('footer.php');?>