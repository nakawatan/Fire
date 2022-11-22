<?php 
include "db/db_con.php";
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="font-size: 13px;">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary" style="text-align: center; font-size: 15px;">FIRE SAFETY INSPECTION CERTIFICATE APPLICATION FORM OF CLIENT</div>
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
                                            <th>Status</th>
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
                                                $data = json_encode($row);

                                                $appnum=$row['appnum'];
                                                $nowner=$row['nowner'];
                                                $esname=$row['esname'];
                                                $date=$row['date'];
                                                $contact=$row['contact'];
                                                $address=$row['address'];
                                                $status ="Pending";
                                                if ($row['status'] != ""){
                                                    $status = $row['status'];
                                                }
                                                ?>
                                                <tr data-attr-details='<?php echo $data; ?>' >
                                                    <td><?php echo $row['appnum']; ?></td>
                                                    <td><?php echo $row['nowner']; ?></td>
                                                    <td><?php echo $row['esname']; ?></td>
                                                    <td><?php echo date("F d, Y",strtotime($date)) ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td><button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>
                                                        <div class="dropdown-menu text-center" style="padding: 10px;">
                                                            <a href="staff-edit.php?updateid=<?php echo $row['nowner'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm text-white btn bg-success add-payment-btn" data-toggle="modal" 
                                                            data-target="#Payment"><i class="fas fa-money-bill"></i></a>

                                                            <a href="re-view.php?updateid=<?php echo $row['id'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm text-white btn bg-info"><i class="fas fa-eye"></i></a>

                                                            <a href="staff-edit.php?updateid=<?php echo $row['nowner'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm text-white btn bg-secondary update-status-btn" data-toggle="modal" 
                                                            data-target="#Status"><i class="fas fa-lightbulb"></i></a>

                                                            <a href="staff-edit.php?updateid=<?php echo $row['nowner'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm btn btn-warning update-appnum" data-toggle="modal" 
                                                            data-target="#AppNumber"><i class="fas fa-pen-square"></i></a>

                                                            <a href="re-delete.php?deleteid=<?php echo $row['nowner'];?>" 
                                                            class="d-none d-sm-inline-block btn btn-sm btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

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

<script>
    $('.update-status-btn').on('click',function(){
        data = JSON.parse($(this).parents('tr').attr('data-attr-details'));
        $('.update-status-submit').attr('data-attr-id',data.id);
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

    $('.update-appnum').on('click',function(){
        data = JSON.parse($(this).parents('tr').attr('data-attr-details'));
        $('.update-appnum-submit').attr('data-attr-id',data.id);
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
                window.location.reload();
            }
        });
    });

    // adding of payment
    $('.add-payment-btn').on('click',function(){
        data = JSON.parse($(this).parents('tr').attr('data-attr-details'));
        $('.add-payment-submit').attr('data-attr-id',data.id);
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
</script>
