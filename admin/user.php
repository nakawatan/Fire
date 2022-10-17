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
                          <div class="pull-left m-0 font-weight-bold text-primary"> Users
                          <a href="user-create.php"><button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary">Add New User</button></a>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>

                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $sql = "SELECT * FROM user ORDER BY id DESC";
                                        $result = mysqli_query($con,$sql);
                                        $i=1;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $img=$row['image'];
                                                $name=$row['name'];
                                                $uname=$row['username'];
                                                $status=$row['status'];
                                               
                                                ?>
                                                <tr>
                                                    
                                                    <td><img src="<?php echo "img/".$row['image'];?>" class="img-circle" alt="Cinque Terre" width="60" height="60"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php 
                                                            if ($row['status'] == "Active") {
                                                                echo "<span class='badge badge-success'>Active</span>";
                                                            }
                                                            else{
                                                                echo "<span class='badge badge-danger'>Inactive</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><a href="user-edit.php?updateid=<?php echo $row['id'];?>" 
                                                        class="btn btn-success"><i class="fas fa-pen-square"></i></a>
                                                        <a href="user-delete.php?deleteid=<?php echo $row['id'];?>" 
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