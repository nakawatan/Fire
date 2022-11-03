<?php 
include "db/db_con.php";
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="font-size: 14px;">
                        <div class="card-header py-3">
                          <a href="anno-create.php"><button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-bullhorn"></i> Add New Announcement</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Detail</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $sql = "SELECT * FROM anno ORDER BY id DESC";
                                        $result = mysqli_query($con,$sql);
                                        $i=1;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
    
                                                $img=$row['image'];
                                                $title=$row['title'];
                                                $details=$row['detail'];
                                                $date=$row['date'];
                                                ?>
                                                <tr>
                                                    <td><img src="<?php echo "img/".$row['image'];?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['detail']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>
                                                        <div class="dropdown-menu text-center">
                                                            <a href="anno-edit.php?updateid=<?php echo $row['id'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm btn btn-success"><i class="fas fa-pen-square"></i></a>
                                                            <a href="anno-delete.php?deleteid=<?php echo $row['id'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </div>    
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