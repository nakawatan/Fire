<?php 
include "db/db_con.php";
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="font-size: 15px;">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary" style="font-size: 15px;">
                             Non Compliant
                             <a class='d-none d-sm-inline-block btn btn-sm btn btn-success' style='float: right;' target='_blank' href='/admin/print_list.php?status=Non Compliant'><i class="fas fa-print"></i> Print<a>
                          </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Application Number</th>
                                            <th>Name of Owner</th>
                                            <th>Date Sent</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $sql = "SELECT * FROM `record` WHERE `status` = 'Non Compliant' ORDER BY id DESC";
                                        $result = mysqli_query($con,$sql);
                                        $i=1;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $appnum=$row['appnum'];
                                                $nowner=$row['nowner'];
                                                $date=$row['date'];
                                                $contact=$row['contact'];
                                                $address=$row['address'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['appnum']; ?></td>
                                                    <td><?php echo $row['nowner']; ?></td>
                                                    <td><?php echo date("F d, Y",strtotime($date)) ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td>
                                                        <a href="re-view.php?updateid=<?php echo $row['id'];?>" 
                                                        class="d-none d-sm-inline-block btn btn-sm text-white btn bg-info"><i class="fas fa-eye"></i> VIEW</a>
                                                    </td>
                                                </tr>

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
                                                                            <option>Compliant</option>
                                                                            <option>Declined</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary">Save changes</button>
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
                                                                        <input type="text" style="font-size: 15px;" class="form-control" name="amount" id="title" placeholder="Application Number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        
                                        ?>
                                    </tbody>
                                
                                </table>
                               
                            </div>
                        </div>
                    </div>
<?php include ('footer.php');?>