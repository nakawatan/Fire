<?php 
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                   
                    <div class="row">
                        
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img src="" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="..." class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="..." class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Request</h6>
                                    </div>
                                    <div class="card-body" style="font-size: 14px;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>

                                                        <th>Date Sent</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            
                                            </table>
                               
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                                            
                

<?php include ('footer.php');?>