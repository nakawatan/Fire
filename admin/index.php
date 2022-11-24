<?php 
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
if ($_SESSION['type'] == 2) {
    session_unset();
    echo "<script>window.location.href='login.php'</script>";
    exit();
}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Requests</div>
                                            <div class="all-request h5 mb-0 font-weight-bold text-gray-800">78</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Declined Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Declined</div>
                                            <div class="declined-request h5 mb-0 font-weight-bold text-gray-800">30</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Processing Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Processing</div>
                                            <div class="pending-request h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Finished Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Finished</div>
                                            <div class="finished-request h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Calendar</h6>
                                </div>
                                <div class="card-body">
                                <div id='calendar' class="my-calendar" ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal AppNumber-->
                    <div class="modal fade" id="add-new-schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Add New Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <input type="text" style="font-size: 15px;" class="form-control" name="title" id="title-input" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <textarea placeholder="Details" class="form-control" id ="details-input"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success add-scheduler-submit">Add Schedule</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal edit-->
                    <div class="modal fade" id="edit-new-schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Edit Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <input type="text" style="font-size: 15px;" class="form-control" name="title" id="title-edit-input" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <textarea placeholder="Details" class="form-control" id ="details-edit-input"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-delete">Delete</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success edit-scheduler-submit">Edit Schedule</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal delete-->
                    <div class="modal fade" id="delete-schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 15px;" id="exampleModalLabel">Edit Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <h3>Are you sure to delete this schedule?</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success delete-scheduler-submit">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include ('footer.php');?>
<link href='/js/fullcalendar/main.css' rel='stylesheet' />
<script src='/js/fullcalendar/main.js'></script>
<script>
    $('.btn-delete').on('click',function(){
        $('.delete-scheduler-submit').attr('data-id',$(this).attr('data-id'));
        $('#delete-schedule').modal('show');
    });

    $('.delete-scheduler-submit').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"delete_schedule",
                id:$(this).attr('data-id'),
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });
    
    $.ajax({
        url: '/api/',
        data: {
            method:"get_metrics"
        },
        method: 'POST',
        dataType:"json",
        success: function(response) {
            $('.all-request').text(response.metrics.records);
            $('.declined-request').text(response.metrics.declined);
            $('.pending-request').text(response.metrics.processing);
            $('.finished-request').text(response.metrics.finish);
        }
    });

    $('.add-scheduler-submit').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"add_schedule",
                title:$('#title-input').val(),
                details:$('#details-input').val(),
                date:selected_date,
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });
    $('.edit-scheduler-submit').on('click',function(){
        $.ajax({
            url: '/api/',
            data: {
                method:"update_schedule",
                title:$('#title-edit-input').val(),
                details:$('#details-edit-input').val(),
                id:$(this).attr('data-id')
            },
            method: 'POST',
            dataType:"json",
            success: function(response) {
                window.location.reload();
            }
        });
    });
    var selected_date = "";
    $(function() {
                var calendar;
                    var calendarEl = document.getElementById('calendar');
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        contentHeight: 500,
                        events: {
                            url: '/api/?method=get_schedules'
                        },
                        eventClick: function(info) {
                            console.log(info);
                            
                            $('.btn-delete').attr('data-id',info.event.extendedProps.obj_id);
                            $('.edit-scheduler-submit').attr('data-id',info.event.extendedProps.obj_id);
                            $('#details-edit-input').val(info.event.extendedProps.details);
                            $('#title-edit-input').val(info.event.title);
                            $('#edit-new-schedule').modal('show');
                        },
                        loading: function( isLoading ) {
                            if (isLoading == true) {
                                //show your loader
                            } else {
                                // setTimeout(loadCurrentEvent, 3000);
                            }
                        },
                        eventTimeFormat: { // like '14:30:00'
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: true
                        },
                        dateClick: function(info) {
                            if (info.date < new Date()) {
                                return;
                            }
                            $("#add-new-schedule").modal('show');
                            console.log(info)
                            selected_date = info.dateStr;
                            // alert('Clicked on: ' + info.dateStr);
                            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                            // alert('Current view: ' + info.view.type);
                            // change the day's background color just for fun
                            // info.dayEl.style.backgroundColor = 'red';
                        },
                        eventMouseEnter:function(info){
                            // var myTarget = $(info.jsEvent.target);

                            // if (!myTarget.hasClass('fc-event')) {
                            //     myTarget = myTarget.closest('.fc-event');
                            // }
                            // myTarget.css("display","inline-table");
                        },
                        eventMouseLeave: function(info) {
                            // var myTarget = $(info.jsEvent.target);

                            // if (!myTarget.hasClass('fc-event')) {
                            //     myTarget = myTarget.closest('.fc-event');
                            // }
                            // myTarget.css("display","");
                        }
                    });
                calendar.render();
                $('.fc-event').mouseenter(function() {
                    $(this).addClass('fc-event-hover');
                });
                $('.fc-event').mouseleave(function() {
                    $(this).removeClass('fc-event-hover');
                });
            });
</script>
            