<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
include_once ('classes/record.php');
include_once ('classes/occupancy_docs.php');
include_once ('classes/new_business_doc.php');
include_once ('classes/renewal_business_doc.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['create'])) {
    $record = new Record();
    $nowner=$_POST['nowner'];
    $esname=$_POST['esname'];
    $autho=$_POST['autho'];
    $address=$_POST['address'];
    $bnature=$_POST['bnature'];
    $area=$_POST['area'];
    $contact=$_POST['contact'];
    $date=$_POST['date'];
    $type=$_POST['application-type-input'];
    $client_id = $_SESSION['id'];
    $no_of_storey = $_REQUEST['no_of_storey'];

    $record->nowner = $nowner;
    $record->esname = $esname;
    $record->author = $autho;
    $record->address = $address;
    $record->bnature = $bnature;
    $record->area = $area;
    $record->contact = $contact;
    $record->date = $date;
    $record->type = $type;
    $record->client_id = $client_id;
    $record->no_of_storey = $no_of_storey;

    $record->save();

    // process documents attachments
    if ($type == 1) {
        $doc = new OccupancyDocs();
        $doc->record_id = $record->id;
        $doc->UploadFile();
        $doc->save();
    }else if ($type == 2){
        $doc = new NewBusinessDoc();
        $doc->record_id = $record->id;
        $doc->UploadFile();
        $doc->save();
    }else {
        $doc = new RenewalBusinessDoc();
        $doc->record_id = $record->id;
        $doc->UploadFile();
        $doc->save();
    }
        echo "<script>alert('Successfully added new application request!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    
    // $sql = "INSERT INTO `record`(`nowner`, `esname`, `autho`, `address`, `bnature`, `area`, `contact`, `date`) 
    // VALUES   ('$nowner', '$esname', '$autho', '$address', '$bnature', '$area', '$contact', '$date')";

    // $result = mysqli_query($con,$sql);

    // if ($result){
    //     echo "<script>window.location.href='form2.php'</script>";
    // }else{
    //     echo "<script>alert('Something is wrong with the insertion of the register.');</script>";
    //     echo "<script>window.location.href='form2.php'</script>";
    // }
    
}
?>
<style>
    .mb-limit {
        color: #d30d0d;
        font-size: 8px;
    }
</style>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="font-size: 13px;">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-danger">
                          FIRE SAFETY INSPECTION CERTIFICATE APPLICATION FORM</div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <a class="nav-link active btn-tab-details" data-toggle="tab"  href="#details">Details</a>
                            <a class="nav-link card-header btn-tab-documents" data-toggle="tab" href="#documents">Documents</a>
                        </ul>
                        <form method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                <div id="details" class="tab-pane in active">
                                    <div class="card-body row g-3">
                                        
                                        <!-- Tab selection details or documents -->
                                        
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Name of Owner:</label>
                                            <input type="text" name="nowner" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Establishment Name:</label>
                                            <input type="text" name="esname" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Exact Address:</label>
                                            <input type="text" name="address" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Authorized Representative:</label>
                                            <input type="text" name="autho" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Business Nature:</label>
                                            <input type="text" name="bnature" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Total Floor Area(M2):</label>
                                            <input type="text" name="area" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Contact Number:</label>
                                            <input type="text" name="contact" class="form-control form-control-line" minlength="11" maxlength="12" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Date:</label>
                                            <input type="date" name="date" id="example-email2" name="example-email" class="form-control" required> 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>No. of Storey:</label>
                                            <input type="text" name="no_of_storey" class="form-control form-control-line" required > 
                                        </div>
                                        <div class="form-group col-md-6 m-t-20">
                                            <label>Application Type:</label>
                                            <select id="application-type-input" name="application-type-input" class="form-control">
                                                <option value="1">FSIC for Certicate of Occupancy</option>
                                                <option value='2'>New Business</option>
                                                <option value='3'>Renewal of Business</option>
                                            </select>
                                        </div>
                                        <div class="form-actions col-md-12">
                                            <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-default">Clear</button>
                                            <a href="#documents"><button type="button" class="btnNext float-right d-none d-sm-inline-block text-white btn btn-sm bg-info">
                                            Next</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="documents" class="tab-pane">
                                <div class="card-header py-3">
                                    <div class="m-0 font-weight-bold text-danger" style="text-align: center;">
                                    ATTACHED DOCUMENTARY REQUIREMENTS</div>
                                    
                                    </div>
                                    <!-- occupancy -->
                                    <div class="card-body" id="application-type-1">
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">ENDORSEMENT FROM OFFICE OF THE BUILDING OFFICIAL (OBO)
                                                <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="obo-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">CERTIFICATE OF COMPLETION 
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="coc-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">CERTIFIED TRUE COPY OF ASSESSMENT FEE FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="cto-sc-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">AS-BUILT PLAN (IF NECESSARY)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="as-built-plan-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">ONE (1) SET OF FIRE SAFETY COMPLIANCE AND COMMISSIONING REPORT (FSCCR) (IF NECESSARY)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="fsccr-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-actions col-md-12">
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success" name="create">Submit</button>
                                            <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-default">Clear</button>
                                            <a><button type="button" class="btnPrevious float-right d-none d-sm-inline-block text-white btn btn-sm bg-info">
                                            Back</button></a>
                                        </div>
                                    </div>
                                    <!-- end occupancy -->

                                    <!-- new business -->
                                    <div class="card-body" id="application-type-2" style="display:none">
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="coo-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">ASSESSMENT OF BUSINESS PERMIT FEE/ TAX ASSESSMENT BILL FROM BPLO
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="bus-permit-fee-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANTIAL CHANGES MADE ON BUILDING/ESTABLISHMENT
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="appidavit-of-undertaking-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">COPY OF FIRE INSURANCE (IF NECESSARY)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="new-cof-insurance-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-actions col-md-12">
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success" name="create">Submit</button>
                                            <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-default">Clear</button>
                                            <a><button type="button" class="btnPrevious float-right d-none d-sm-inline-block text-white btn btn-sm bg-info">
                                            Back</button></a>
                                        </div>
                                    </div>
                                    <!-- end new business -->

                                    <!-- renew business -->
                                    <div class="card-body" id="application-type-3" style="display:none">
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="business-permit-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">COPY OF FIRE INSURANCE (IF NECESSARY)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="cof-insurance-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">ONE (1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF  NECESSARY)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="fsmr-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-group col-md-20 m-t-20">
                                            <h4 class="small font-weight-bold">FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS (IF REQUIRED)
                                            <label class="mb-limit">(Max File Size: 5MB)</label>
                                            </h4>
                                            <input type="file" name="fscfw-input" class="form-control" value="" style="font-size: 13px;">
                                        </div>
                                        <div class="form-actions col-md-12">
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success" name="create">Submit</button>
                                            <button type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-default">Clear</button>
                                            <a><button type="button" class="btnPrevious float-right d-none d-sm-inline-block text-white btn btn-sm bg-info">
                                            Back</button></a>
                                        </div>
                                    </div>
                                    <!-- end renew business -->
                                </div>
                            </div>
                        </form>
                    </div>
<?php include ('footer.php');?>
<script>
    $('#application-type-input').on('change',function(){
        $('#documents').find('.card-body').hide();
        $('#application-type-' + $(this).val()).show();
    });
    $('.btnNext').click(function(){
        $active = $('.nav-tabs > .active');
        $('.btn-tab-documents').click();
        $('.btn-tab-documents').parent('li').addClass('active');
        $active.removeClass('active');
    });

    $('.btnPrevious').click(function(){
        $active = $('.nav-tabs > .active');
        $('.btn-tab-details').click();
        $('.btn-tab-details').parent('li').addClass('active');
        $active.removeClass('active');
    });

    $('[type="file"]').on('change',function(){
        var input = $(this)[0];
        if (!input.files) { // This is VERY unlikely, browser support is near-universal
            console.error("This browser doesn't seem to support the `files` property of file inputs.");
        } else if (!input.files[0]) {
            addPara("Please select a file before clicking 'Load'");
        } else {
            var file = input.files[0];
            if ((file.size/1000)/1000 > 5){
                alert("Max file size limit is 5mb");
                $(this).val('');
            }
        }
    })
</script>