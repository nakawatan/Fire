</div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- change password modal -->
    <div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="card-body">
                                <div class="form-group col-md-12 ">
                                    <label>Current Password</label>
                                    <input type="password" id="current-password" class="form-control form-control-line" placeholder="" required > 
                                </div>
                                <div class="form-group col-md-12">
                                    <label>New Password</label>
                                    <input type="password" id="new-password" class="form-control form-control-line" placeholder="" required > 
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Confirm Password</label>
                                    <input type="password" id="confirm-password" class="form-control form-control-line" placeholder="" required > 
                                </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary change-password-submit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="js/tether.min.js"></script>

    <script>
        $('.change-password-btn').on('click',function(){
            $('#change-password-modal').modal('show');
        });

        $('.change-password-submit').on('click',function(){
            if ($('#new-password').val() != $('#confirm-password').val()) {
                alert('New Password does not match.');
                return;
            }
            $.ajax({
                url: '/api/',
                data: {
                    method:"change_admin_password",
                    current_password:$('#current-password').val(),
                    new_password: $('#new-password').val()
                },
                method: 'POST',
                dataType:"json",
                success: function(response) {
                    if (response.status == "ok"){
                        window.location.href="login.php";
                    }else {
                        alert(response.msg);
                    }
                }
            });
        });

        setInterval(function () {
            $.ajax({
                url: '/api/',
                data: {
                    method:"get_notification_count"
                },
                method: 'POST',
                dataType:"json",
                success: function(response) {
                    if (response.status == "ok"){
                        $('.badge-counter').text(response.count);
                    }
                }
            });
        }, 5000);

        $('.show-more').on('click',function(){
            $.ajax({
                url: '/api/',
                data: {
                    method:"get_notifications"
                },
                method: 'POST',
                dataType:"json",
                success: function(response) {
                    $.each(response.records,function(k,v){
                        $viewed = "white";
                        if (v.viewed == 0) {
                            $viewed = "#e7e2e2";
                        }
                        $('.notification-list').append(
                            $("<a>")
                            .css('background',$viewed)
                            .attr('data-id',v.obj_id).addClass('dropdown-item d-flex align-items-center my-notification').attr('href','#')
                            .append(
                                $('<div>').addClass('mr-3')
                                .append(
                                    $('<div>').addClass('icon-circle bg-primary')
                                    .append(
                                        $('<i>').addClass('fas fa-file-alt text-white')
                                    )
                                ),
                                $('<div>').append(
                                    $('<div>').addClass('small text-gray-500').text(v.date),
                                    $('<div>').addClass('font-weight-bold').text(v.message)
                                )
                            )
                        )
                    });
                    $('.my-notification').unbind().on('click',function(){
                        window.location.href="re-view.php?updateid=" + $(this).attr('data-id');
                    });
                }
            });
        });

        $('.notification-clicker').on('click',function(){
            $.ajax({
                url: '/api/',
                data: {
                    method:"get_notifications"
                },
                method: 'POST',
                dataType:"json",
                success: function(response) {
                    $('.notification-list').empty();
                    $.each(response.records,function(k,v){
                        $viewed = "white";
                        if (v.viewed == 0) {
                            $viewed = "#e7e2e2";
                        }
                        $('.notification-list').append(
                            $("<a>")
                            .css('background',$viewed)
                            .attr('data-id',v.obj_id).addClass('dropdown-item d-flex align-items-center my-notification').attr('href','#')
                            .append(
                                $('<div>').addClass('mr-3')
                                .append(
                                    $('<div>').addClass('icon-circle bg-primary')
                                    .append(
                                        $('<i>').addClass('fas fa-file-alt text-white')
                                    )
                                ),
                                $('<div>').append(
                                    $('<div>').addClass('small text-gray-500').text(v.date),
                                    $('<div>').addClass('font-weight-bold').text(v.message)
                                )
                            )
                        )
                    });
                    $('.my-notification').unbind().on('click',function(){
                        window.location.href="re-view.php?updateid=" + $(this).attr('data-id');
                    });
                }
            });
        });
    </script>

</body>

</html>