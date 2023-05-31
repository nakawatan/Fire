<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
$root = dirname(__FILE__, 2);
include_once 'classes/new_business_doc.php';
include_once 'classes/renewal_business_doc.php';
include_once 'classes/occupancy_docs.php';
                                        
$id = $_REQUEST['id'];
$sql = "SELECT * FROM `record` where id = ".$id." ORDER BY id DESC";
$result = mysqli_query($con,$sql);
$i=1;
$can_proceed = true;
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

        if ($row['status'] != "") {
            if ($row['status'] == "Non Compliant") {
                $can_proceed = false;
            }else {
                if ($row['amount']) {
                    $can_proceed = false;
                }
            }
        }
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
                                    <div  class="small font-weight-bold col-sm-6">ENDORSEMENT FROM OFFICE OF THE BUILDING OFFICIAL (OBO)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['obo_endoursement']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['obo_endoursement_status'])) {
                                            $can_proceed=false; ?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_occupancy_doc" name="obo_endoursement_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_occupancy_doc" name="obo_endoursement_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['obo_endoursement_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div  class="small font-weight-bold col-sm-6">CERTIFICATE OF COMPLETION </div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['certificate_of_completion']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['certificate_of_completion_status'])) {
                                            $can_proceed=false; ?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_occupancy_doc" name="certificate_of_completion_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_occupancy_doc" name="certificate_of_completion_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['certificate_of_completion_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">CERTIFIED TRUE COPY OF ASSESSMENT FEE FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['assessment_fee']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['assessment_fee_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_occupancy_doc" name="assessment_fee_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_occupancy_doc" name="assessment_fee_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['assessment_fee_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">AS-BUILT PLAN (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['as_built_plan']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['as_built_plan_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_occupancy_doc" name="as_built_plan_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_occupancy_doc" name="as_built_plan_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['as_built_plan_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">ONE (1) SET OF FIRE SAFETY COMPLIANCE AND COMMISSIONING REPORT (FSCCR) (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fsccr']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['fsccr_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_occupancy_doc" name="fsccr_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_occupancy_doc" name="fsccr_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['fsccr_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
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
                                    <div class="small font-weight-bold col-sm-6">CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['certificate_of_occupancy']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['certificate_of_occupancy_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_new_doc" name="certificate_of_occupancy_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_new_doc" name="certificate_of_occupancy_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['certificate_of_occupancy_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">ASSESSMENT OF BUSINESS PERMIT FEE/ TAX ASSESSMENT BILL FROM BPLO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['business_permit_fee']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['business_permit_fee_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_new_doc" name="business_permit_fee_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_new_doc" name="business_permit_fee_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['business_permit_fee_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANTIAL CHANGES MADE ON BUILDING/ESTABLISHMENT</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['appidavit_of_undertaking']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['appidavit_of_undertaking_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_new_doc" name="appidavit_of_undertaking_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_new_doc" name="appidavit_of_undertaking_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['appidavit_of_undertaking_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">COPY OF FIRE INSURANCE (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_insurance']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['fire_insurance_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_new_doc" name="fire_insurance_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_new_doc" name="fire_insurance_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['fire_insurance_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
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
                                    <div class="small font-weight-bold col-sm-6">ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['business_permit_fee']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['business_permit_fee_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_renewal_doc" name="business_permit_fee_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_renewal_doc" name="business_permit_fee_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['business_permit_fee_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">COPY OF FIRE INSURANCE (IF NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_insurance']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['fire_insurance_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_renewal_doc" name="fire_insurance_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_renewal_doc" name="fire_insurance_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['fire_insurance_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">ONE (1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF  NECESSARY)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fsmr']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['fsmr_status'])) { 
                                            $can_proceed=false;?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_renewal_doc" name="fsmr_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_renewal_doc" name="fsmr_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['fsmr_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="small font-weight-bold col-sm-6">FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS (IF REQUIRED)</div>
                                    <div class="col-sm-4"><img class='img' width="250px" src="<?php echo $objs['fire_safety_clearance']; ?>"></img></div>
                                    <div  class="small font-weight-bold col-sm-2">
                                        <?php if (is_null($objs['fire_safety_clearance_status'])) {
                                            $can_proceed=false; ?>
                                            
                                        <button title="Reject" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-danger update_renewal_doc" name="fire_safety_clearance_status" data-attr-value="0"><i class="">&times;</i></button>
                                        <button title="Approve" data-attr-id="<?php echo $objs['id']; ?>" class="btn btn-small btn-success update_renewal_doc" name="fire_safety_clearance_status" data-attr-value="1"><i class="fas fa-check"></i></button>
                                        <?php } else { 
                                            if ($objs['fire_safety_clearance_status'] == 1)    {
                                                echo "Approved";
                                            }else{
                                                echo "Declined";
                                            }
                                        ?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- <div class="form-group col-md-20 m-t-20">
                                    <a href="request.php"><button type="button" class="float-right d-none d-sm-inline-block btn btn-sm btn-danger">
                                    Back</button></a>
                                    <?php if ($can_proceed) { 
                                        $data = json_encode($row); ?>
                                        <a href="#"><button type="button" class="float-right d-none d-sm-inline-block btn btn-sm btn-success proceed-btn" data-attr-appnum="<?php echo $appnum; ?>" data-attr-details='<?php echo $data; ?>'>Proceed</button></a>
                                    <?php } ?>
                                </div> -->
                            </div>
                        </div>
                        <div class="modal fade" id="image-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                   
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
                    <!-- Modal Payment-->
                    <div class="modal fade" id="Payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Add Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <label>Payment:</label>
                                            <input type="text" style="font-size: 15px;" class="form-control" name="payment" id="amount-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <label>Date:</label>
                                            <input type="date" style="font-size: 15px;" class="form-control" name="date" id="payment-date-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success add-payment-submit">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal AppNumber-->
                    <div class="modal fade" id="AppNumber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Application Number</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <input type="text" style="font-size: 15px;" class="form-control" name="amount" id="appnum-input" placeholder="Application Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success update-appnum-submit">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Status-->
                    <div class="modal fade" id="Status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <select class="form-control select2" style="font-size: 15px;" id="exampleSelect1" name="status">
                                                <option></option>
                                                <option value="Compliant">Compliant</option>
                                                <option value="Non Compliant">Non Compliant</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success update-status-submit">Save changes</button>
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

    $('.update_new_doc').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"update_new_business_doc_status",
                field:$(this).attr('name'),
                status:$(this).attr('data-attr-value'),
                id:$(this).attr('data-attr-id')
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $('.update_occupancy_doc').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"update_occupancy_doc_status",
                field:$(this).attr('name'),
                status:$(this).attr('data-attr-value'),
                id:$(this).attr('data-attr-id')
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $('.update_renewal_doc').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"update_renewal_doc_status",
                field:$(this).attr('name'),
                status:$(this).attr('data-attr-value'),
                id:$(this).attr('data-attr-id')
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $('.proceed-btn').on('click',function(){
        data = JSON.parse($(this).attr('data-attr-details'));
        console.log(data);
        $('.update-appnum-submit').attr('data-attr-id',data.id);
        $('.update-status-submit').attr('data-attr-id',data.id);
        $('.add-payment-submit').attr('data-attr-id',data.id);
        if ($(this).attr('data-attr-appnum') == "") {
            $('#AppNumber').modal('show');
        }else {
            if (data.status == null){
                $('#Status').modal('show');
            }else {
                if (data.status =="Compliant"){
                    $('#Payment').modal('show');
                }
            }
        }
    });

    $('.add-payment-submit').on('click',function(){
        if ($("#amount-input").val() =="") {
            return;
        }
        if ($("#payment-date-input").val() =="") {
            return;
        }
        $.ajax({
            url: '/api/',
            data: {
                method:"add_payment",
                id:$(this).attr('data-attr-id'),
                amount:$("#amount-input").val(),
                payment_review_date:$("#payment-date-input").val()
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $('.update-appnum-submit').on('click',function(){
        if ($("#appnum-input").val() =="") {
            return;
        }
        $.ajax({
            url: '/api/',
            data: {
                method:"update_record",
                id:$(this).attr('data-attr-id'),
                app_num:$("#appnum-input").val()
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                console.log(response);
                if (response.status == "ok"){
                    alert("Application number was saved.");
                    window.location.reload();
                }else {
                    alert(response.msg);
                }
            }
        });
    });

    $('.update-status-submit').on('click',function(){
        if ($("#exampleSelect1").val() =="") {
            return;
        }
        $.ajax({
            url: '/api/',
            data: {
                method:"update_record",
                id:$(this).attr('data-attr-id'),
                status:$("#exampleSelect1").val()
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });
</script>