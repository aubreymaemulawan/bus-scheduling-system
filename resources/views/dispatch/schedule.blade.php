@extends('layouts.app')
@section('title','Dispatch Schedules')

@section('dispatch_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 id="name_head" class="h5 mb-2 text-gray-800"><strong style="color:#4e73df">{{Auth::user()->name}}</strong> here is your schedules!</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Route</th>
                                <th>Bus</th>
                                <th>Operator</th>
                                <th>Dispatcher</th>
                                <th>FT</th>
                                <th>LT</th>
                                <th>Interval</th>
                                <th>Trips</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $sched)
                                @if($sched->dispatcher_id == Auth::user()->dispatcher_id)
                                    <tr> 
                                        <td>{{$sched->date}}</td>
                                        <td>{{$sched->route->from_to_location}}</td>
                                        <td>{{$sched->bus->bus_no}} - {{$sched->bus->bustype->bus_type}}</td>
                                        <td>{{$sched->operator->name}}</td>
                                        <td>{{$sched->dispatcher->name}}</td>
                                        <td>{{$sched->first_trip}}</td>
                                        <td>{{$sched->last_trip}}</td>
                                        <td>{{$sched->interval_mins}} mins</td>
                                        <td>/{{$sched->max_trips}}</td>
                                        @if ($sched->is_active == 1)
                                        <td style="color:#1cc88a"><strong>Active</strong></td>
                                        @elseif ($sched->is_active == 2)
                                        <td style="color:#e74a3b"><strong>Inactive</strong></td>
                                        @endif
                                        <td>
                                            <a href="./dispatch-trip" class="btn btn-sm btn-success">Start Trip</a>
                                        </td>  
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
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
        $('#main-schedule').addClass('active')

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