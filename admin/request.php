<?php 
include "db/db_con.php";
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary" style="text-align: center;">FIRE SAFETY INSPECTION CERTIFICATE APPLICATION FORM OF CLIENT</div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Application Number</th>
                                            <th>Name of Owner</th>
                                            <th>Establishment Name</th>
                                            <th>Date</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $sql = "SELECT * FROM `record` ORDER BY id DESC";
                                        $result = mysqli_query($con,$sql);
                                        $i=1;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $appnum=$row['appnum'];
                                                $nowner=$row['nowner'];
                                                $esname=$row['esname'];
                                                $date=$row['date'];
                                                $contact=$row['contact'];
                                                $address=$row['address'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['appnum']; ?></td>
                                                    <td><?php echo $row['nowner']; ?></td>
                                                    <td><?php echo $row['esname']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><a href="staff-edit.php?updateid=<?php echo $row['id'];?>" 
                                                        class="btn btn-success"><i class="fas fa-pen-square"></i></a>
                                                        <a href="re-delete.php?deleteid=<?php echo $row['id'];?>" 
                                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
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