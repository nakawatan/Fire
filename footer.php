    
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
                    <a class="btn btn-primary" href="d_logout.php">Logout</a>
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
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        // script needed by the system for global userDropdown
        // set interval if 5 seconds to fetch notifications
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
                        $('.notification-list').append(
                            $("<a>").addClass('dropdown-item d-flex align-items-center').attr('href','#')
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
                    })
                }
            });
        });
    </script>

</body>

</html>