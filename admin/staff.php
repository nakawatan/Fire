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
                          <div class="pull-left m-0 font-weight-bold text-primary"> Staff List
                          <a href="staff-create.php"><button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary">Add New Staff</button></a>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $sql = "SELECT * FROM staff ORDER BY id DESC";
                                        $result = mysqli_query($con,$sql);
                                        $i=1;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $id=$row['id'];
                                                $img=$row['image'];
                                                $name=$row['name'];
                                                $email=$row['email'];
                                                $cont=$row['contact'];
                                                $role=$row['role'];
                                                ?>
                                                <tr>
                                                    <th><?php echo $row['id']; ?></th>
                                                    <td><img src="<?php echo "img/".$row['image'];?>" class="img-circle" alt="Cinque Terre" width="60" height="60"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
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
                </div>
                <!-- /.container-fluid -->
<?php include ('footer.php');?>