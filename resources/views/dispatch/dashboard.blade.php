@extends('layouts.app')
@section('title','Dashboard')

@section('dispatch_content')
    <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome {{Auth::user()->name}}!</h1>
    </div>
        <div class="row">
            <!-- My Schedules Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Schedules</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Trips Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Trips</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Transactions Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transactions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Failed Schedules Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Failed Schedules</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                 <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Reminders</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_events.svg" alt="...">
                        </div>
                        <p>Hello {{Auth::user()->name}}! Dont forget to check first your schedule before your trips. Have a safe and wonderful ride.
                        </p>
                        <a target="_blank" rel="nofollow" href="./dispatch-schedule">Get to know your schedules here &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
                $('#company_id').on('change', function () {
                    var companyId = this.value;
                    $('#bus_id').html('');
                    $.ajax({
                        url: '{{ route('getBus') }}?company_id='+companyId,
                        type: 'get',
                        success: function (res) {
                            $('#bus_id').html('<option value="">Select Bus</option>');
                            $.each(res, function (key, value) {
                                if(value.is_active == 1 && value.bustype_id == 1){
                                    $('#bus_id').append('<option value="' + value.id + '">' + value.bus_no + " - Airconditioned"+'</option>');
                                }else if(value.is_active == 1 && value.bustype_id == 2){
                                    $('#bus_id').append('<option value="' + value.id + '">' + value.bus_no + " - Non-Airconditioned"+'</option>');
                                }
                            });
                        }
                    });
                    
                });

                $('#company_id').on('change', function () {
                    var companyId = this.value;
                    $('#operator_id').html('');
                    $.ajax({
                        url: '{{ route('getOperator') }}?company_id='+companyId,
                        type: 'get',
                        success: function (res) {
                            $('#operator_id').html('<option value="">Select Operator</option>');
                            $.each(res, function (key, value) {
                                if(value.is_active == 1){
                                    $('#operator_id').append('<option value="'+value.id +'">'+value.name+'</option>');
                                }
                            });
                        }
                    });
                });

                $('#company_id').on('change', function () {
                    var companyId = this.value;
                    $('#dispatcher_id').html('');
                    $.ajax({
                        url: '{{ route('getDispatcher') }}?company_id='+companyId,
                        type: 'get',
                        success: function (res) {
                            $('#dispatcher_id').html('<option value="">Select Dispatcher</option>');
                            $.each(res, function (key, value) {
                                if(value.is_active == 1){
                                    $('#dispatcher_id').append('<option value="'+value.id+'">'+value.name+'</option>');
                                }
                            });
                        }
                    });
                });
            } 
        );

        $('[id^="main"]').removeClass('active')
        $('#main-dashboard').addClass('active')

        var modal = '#main-modal';       
        
        function Error(){
            bootbox.alert({
            message: "Please check your Company List and activate status!",
            centerVertical: true,
            size: 'medium'
            })
        }

        function Add(){
            document.getElementById("header-modal").innerHTML="Schedule Information"
            document.getElementById("edit").innerHTML="Create"
            $('#id').val('-1'),
            $('#date').val(''),
            $('#company_id').val(''),
            $('#bus_id').val(''), $('#bus_id').html('');
            $('#operator_id').val(''), $('#operator_id').html(''),
            $('#dispatcher_id').val(''), $('#dispatcher_id').html(''),
            $('#route_id').val(''),
            $('#first_trip').val(''),
            $('#last_trip').val(''),
            $('#interval_mins').val(''),
            $('#max_trips').val(''),
            $(modal).modal(
                {'show':true}
            )
        }
        
        function Save() {
            var data = {
            id: $('#id').val(),
            date: $('#date').val(),
            company_id: $('#company_id').val(),
            bus_id: $('#bus_id').val(),
            operator_id: $('#operator_id').val(),
            dispatcher_id: $('#dispatcher_id').val(),
            route_id: $('#route_id').val(),
            first_trip: $('#first_trip').val(),
            last_trip: $('#last_trip').val(),
            interval_mins: $('#interval_mins').val(),
            max_trips: $('#max_trips').val(),
            is_active: 1,
            }
            if(data.id == -1) {
                Controller.Post('/api/schedule/create', data).done(function(result) {
                    var dialog = bootbox.dialog({
                        centerVertical: true,
                        title: 'Saving Information',
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
                    });
                    $('#main-modal').modal('hide');
                    dialog.init(function(){
                        setTimeout(function(){
                            dialog.find('.bootbox-body').html('Information Successfully saved!');
                            window.location.reload();
                        }, 3000);
                        
                    });
                })
            }
            else if(data.id > 0) {
                Controller.Post('/api/schedule/update', data).done(function(result) {
                    var dialog = bootbox.dialog({
                        centerVertical: true,
                        title: 'Updating Information',
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
                    });
                    $('#main-modal').modal('hide');
                    dialog.init(function(){
                        setTimeout(function(){
                            dialog.find('.bootbox-body').html('Information Successfully updated!');
                            window.location.reload();
                        }, 3000);
                        
                    });
                })       
            }
        }
            
        function Edit(id) {
            document.getElementById("header-modal").innerHTML="Edit Information"
            document.getElementById("edit").innerHTML="Save"
            Controller.Post('/api/schedule/items', { 'id': id }).done(function(result) {
                $('#id').val(result.id)
                $('#date').val(result.date),
                $('#company_id').val(result.company_id),
                $('#bus_id').val(result.bus_id),
                $('#operator_id').val(result.operator_id),
                $('#dispatcher_id').val(result.dispatcher_id),
                $('#route_id').val(result.route_id),
                $('#first_trip').val(result.first_trip),
                $('#last_trip').val(result.last_trip),
                $('#interval_mins').val(result.interval_mins),
                $('#max_trips').val(result.max_trips),
                $(modal).modal({
                    'show': true
                })
            })
        }

        function Delete(id) {
            bootbox.confirm({
                title: "Deleting Information",
                message: "Are you sure you want to delete this item? This cannot be undone.",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                centerVertical: true,
                callback: function(result){
                    if(result) {
                        Controller.Post('/api/schedule/delete', { 'id': id }).done(function(result) {
                            var dialog = bootbox.dialog({
                                centerVertical: true,
                                title: 'Deleting Information',
                                message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
                            });
                            dialog.init(function(){
                                setTimeout(function(){
                                    dialog.find('.bootbox-body').html('Information Successfully deleted!');
                                    window.location.reload();
                                }, 3000);
                                
                            });
                        })
                    }
                }
            })
        }
    </script>
@endsection