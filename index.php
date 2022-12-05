<?php 
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
include_once("classes/record.php");
include_once("classes/announcement.php");
$record = new Record();
$record->client_id = $_SESSION['id'];

if ($_SESSION['type'] == 1) {
    session_unset();
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$data = $record->get_records();

$announcement = new Announcement();
$announcements = $announcement->get_records();
?>
                
<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                   
                    <div class="row">
                        
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4" style="height:100%">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <!-- <div class="carousel-item active">
                                        <img src="" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="..." class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="..." class="d-block w-100" alt="...">
                                        </div> -->
                                        <?php 
                                        $count = 0;
                                        foreach ($announcements as $rec) {
                                            $active="";
                                            if ($count==0) {
                                                $active = "active";
                                                $count++;
                                            }
                                            $image = "/admin/img/".$rec['image'];
                                            $date=date_create($rec['date']);
                                            $date = date_format($date,"Y/m/d h:i A");
                                            echo "
                                            <div class='carousel-item ${active}'>
                                                <img src='${image}' class='d-block w-100' alt=''>
                                                <div class='d-none d-md-block' style='text-align:center'>
                                                    <p><label>Title:</label> ${rec['title']}</p>
                                                    <p><label>Details:</label> ${rec['detail']}</p>
                                                </div>
                                            </div>
                                            ";
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Request</h6>
                                    </div>
                                    <div class="card-body" style="font-size: 14px;">
                                        <div class="table-responsive" style="height:300px;">
                                            <table style="overflow:scroll;
    height:100px;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>

                                                        <th>Date Sent</th>
                                                        <th>App No.</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach ($data as $key) {
                                                            $status = "pending";
                                                            if ($key['status'] != ""){
                                                                $status=$key['status'];
                                                            }
                                                            $action = "";
                                                            if ($key['status'] == "Compliant"){
                                                                $action="<a href='/claim_stub.php?id=${key['id']}' target='_blank' 
                                                                class='d-none d-sm-inline-block btn btn-sm btn btn-success'><i class='fas fa-print'></i></a>";
                                                            }
                                                            echo "<tr>
                                                            <td>${key['date']}</td>
                                                            <td>${key['appnum']}</td>
                                                            <td>${status}</td>
                                                            <td>${action}</td>
                                                            </tr>";
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            
                                            </table>
                               
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                                            
                

<?php include ('footer.php');?>