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
                          <div class="pull-left m-0 font-weight-bold text-primary"> Clients Management 
                             <a href="re-create.php"><button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary">Add New Client</button></a>
                          </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Permit Number</th>
                                            <th>Name</th>
                                            <th>Establishment Type</th>
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
                                                $pnum=$row['permit_num'];
                                                $name=$row['name'];
                                                $etab=$row['estab'];
                                                $cont=$row['contact'];
                                                $address=$row['address'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['permit_num']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['estab']; ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><a href="staff-edit.php?updateid=<?php echo $row['id'];?>" 
                                                        class="btn btn-success"><i class="fas fa-pen-square"></i></a>
                                                        <a href="staff-delete.php?deleteid=<?php echo $row['id'];?>" 
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