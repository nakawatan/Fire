<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
$root = dirname(__FILE__, 2);
include_once $root.'/classes/new_business_doc.php';
include_once $root.'/classes/renewal_business_doc.php';
include_once $root.'/classes/occupancy_docs.php';
                                        
$id = $_REQUEST['updateid'];
$sql = "SELECT * FROM `record` where id = ".$id." ORDER BY id DESC";
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
<style>
/* img{
    transition: transform .2s;
    width:250px;
    margin:0 auto;
    background-color: rgb(173, 173, 237);
    border-radius: 10px;
    border: 1px solid black;
}
img:hover{
    transform:scale(2.5);
} */
</style>
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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">DOCUMENTARY REQUIREMENTS </h6>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified">
                                <?php if($row['type'] == 1){ ?>
                                <li class="nav-item">
                                    <a class="nav-link bg-primary m-0 font-weight-bold text-white" href="#">FSIC FOR CERTIFICATE OF OCCUPANCY</a>
                                </li>
                                <?php } ?>
                                <?php if($row['type'] == 2){ ?>
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-warning" href="#">FOR NEW BUSINESS</a>
                                </li>
                                <?php } ?>
                                <?php if($row['type'] == 3){ ?>
                                <li class="nav-item">
                                    <a class="nav-link m-0 font-weight-bold text-info" href="#">FOR RENEWAL  OF BUSINESS</a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php 
                                if($row['type'] == 1){
                                    $obj = new OccupancyDocs();
                                    $obj->record_id = $row['id'];
                                    $objs = $obj->get_records();
                                    $objs = $objs[0];
                                
                            ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div  class="small font-weight-bold col-sm-8">ENDORSEMENT FROM OFFICE OF THE BUILDING OFFICIAL (OBO)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['obo_endoursement']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div  class="small font-weight-bold col-sm-8">CERTIFICATE OF COMPLETION </div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['certificate_of_completion']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">CERTIFIED TRUE COPY OF ASSESSMENT FEE FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['assessment_fee']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">AS-BUILT PLAN (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['as_built_plan']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">ONE (1) SET OF FIRE SAFETY COMPLIANCE AND COMMISSIONING REPORT (FSCCR) (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fsccr']; ?>"></img></div>
                                </div>
                                <?php } ?>

                                <?php 
                                if($row['type'] == 2){
                                    $obj = new NewBusinessDoc();
                                    $obj->record_id = $row['id'];
                                    $objs = $obj->get_records();
                                    $objs = $objs[0];
                                
                                ?>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['certificate_of_occupancy']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">ASSESSMENT OF BUSINESS PERMIT FEE/ TAX ASSESSMENT BILL FROM BPLO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['business_permit_fee']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANTIAL CHANGES MADE ON BUILDING/ESTABLISHMENT</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['appidavit_of_undertaking']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">COPY OF FIRE INSURANCE (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_insurance']; ?>"></img></div>
                                </div>
                                <?php } ?>

                                <?php 
                                if($row['type'] == 3){
                                    $obj = new RenewalBusinessDoc();
                                    $obj->record_id = $row['id'];
                                    $objs = $obj->get_records();
                                    $objs = $objs[0];
                                
                                ?>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['business_permit_fee']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">COPY OF FIRE INSURANCE (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_insurance']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">ONE (1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF  NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fsmr']; ?>"></img></div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-8">FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS (IF REQUIRED)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_safety_clearance']; ?>"></img></div>
                                </div>
                                <?php } ?>

                                <div class="form-group col-md-20 m-t-20">
                                    <a href="request.php"><button type="button" class="float-right d-none d-sm-inline-block btn btn-sm btn-danger">
                                    Back</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="image-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Add New Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <img width="100%" id="big-image"></img>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php
                                }
                                }
                                            
                            ?>
                             
<?php include ('footer.php');?>

<script>
    $('.img').on('click',function(){
        $('#big-image').attr('src',$(this).attr('src'));
        $('#image-view-modal').modal('show');
    });
</script>