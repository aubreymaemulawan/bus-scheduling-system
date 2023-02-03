@extends('layouts.app')
@section('title','Manage Schedules')

@section('modal')
    <div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df">
                    <h5 id="header-modal" class="modal-title" id="main-modalLabel" style="color:white;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="date">Date (Tomorrow)</label>
                            <input name="date" type="text" class="form-control" id="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control" data-style="btn btn-link" id="company_id">
                                @foreach ($company as $cp)
                                    @if($cp->is_active==1)
                                        <option value="{{$cp->id}}">{{ $cp->company_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bus_id">Bus Number</label>
                            <select name="bus_id" class="form-control" data-style="btn btn-link" id="bus_id">
                                @foreach ($bus as $bs)
                                    @if($bs->is_active==1)
                                        <option value="{{$bs->id}}">{{ $bs->bus_no }} - {{ $bs->bustype->bus_type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="operator_id">Operator</label>
                            <select name="operator_id" class="form-control" data-style="btn btn-link" id="operator_id">
                                @foreach ($operator as $op)
                                    @if($op->is_active==1)
                                        <option value="{{$op->id}}">{{ $op->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dispatcher_id">Dispatcher</label>
                            <select name="dispatcher_id" class="form-control" data-style="btn btn-link" id="dispatcher_id">
                                @foreach ($dispatcher as $dp)
                                    @if($dp->is_active==1)
                                        <option value="{{$dp->id}}">{{ $dp->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="route_id">Route</label>
                            <select name="route_id" class="form-control" data-style="btn btn-link" id="route_id">
                                @foreach ($route as $rt)
                                    <option value="{{$rt->id}}">{{ $rt->from_to_location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_trip">First Trip</label>
                            <input name="first_trip" type="time" class="form-control" id="first_trip">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_trip">Last Trip</label>
                            <input name="last_trip" type="time" class="form-control" id="last_trip">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="interval_mins">Interval Minutes</label>
                            <input name="interval_mins" type="number" class="form-control" id="interval_mins">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_trips">Maximum No. of Trips</label>
                            <input name="max_trips" type="number" class="form-control" id="max_trips">
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="edit" onclick="Save()" type="button" class="btn btn-primary" style="background-color:#4e73df"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Schedule List</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            @if(DB::table('company')->where('is_active','1')->exists())
                <button onclick="Add()" type="button" class="btn btn-sm btn btn-success">Add New</button>
            @else
                <button onclick="Error()" type="button" class="btn btn-sm btn btn-success">Add New</button>
            @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Route</th>
                                <th>Bus</th>
                                <th>Operator</th>
                                <th>Dispatcher</th>
                                <th>Trip</th>
                                <th>Interval</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $sched)
                                @if($sched->is_active==1)
                                <tr> 
                                    <td>{{$sched->date}}</td>
                                    <td>{{$sched->company->company_name}}</td>
                                    <td>{{$sched->route->from_to_location}}</td>
                                    @if($sched->bus->bustype->bus_type=="Airconditioned")
                                    <td>{{$sched->bus->bus_no}} - AC</td>
                                    @elseif($sched->bus->bustype->bus_type=="Non-Airconditioned")
                                    <td>{{$sched->bus->bus_no}} - NAC</td>
                                    @endif
                                    <td>{{$sched->operator->name}}</td>
                                    <td>{{$sched->dispatcher->name}}</td>
                                    <td><strong>First Trip: </strong>({{$sched->first_trip}}) <strong>Last trip: </strong>({{$sched->last_trip}}) <strong>Max: </strong>({{$sched->max_trips}})</td>
                                    <td>{{$sched->interval_mins}} mins</td>
                                    @if ($sched->is_active == 1)
                                    <td style="color:#1cc88a"><strong>Active</strong></td>
                                    @elseif ($sched->is_active == 2)
                                    <td style="color:#e74a3b"><strong>Inactive</strong></td>
                                    @endif
                                    <td>
                                        <button  onclick="Edit({{ $sched->id }})" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                    </td>  
                                    <td>
                                        <button onclick="Delete({{ $sched->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

                $('#dataTable').DataTable();

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

        $('[id^="menu-"]').removeClass('active')
        $('#menu-schedule').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-schedule').addClass('active')
        $('#collapseSchedule').addClass('show')

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
            var today = new Date()
            var dd = String(today.getDate()+1).padStart(2,'0');
            var mm = String(today.getMonth()+1).padStart(2,'0');
            var yyyy = today.getFullYear();
            today = yyyy+'-'+mm+'-'+dd;
            $('#id').val('-1'),
            $('#date').val(today),
            document.getElementById("date").setAttribute("disabled","disabled")
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
                    if(result == 1){
                        bootbox.alert({
                        message: "Bus No already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else if(result == 2){
                        bootbox.alert({
                        message: "Operator already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else if(result == 3){
                        bootbox.alert({
                        message: "Dispatcher already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else{
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
                    }
                }     
            )}
            
            else if(data.id > 0) {
                Controller.Post('/api/schedule/update', data).done(function(result) {
                    if(result == 1){
                        bootbox.alert({
                        message: "Bus No already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else if(result == 2){
                        bootbox.alert({
                        message: "Operator already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else if(result == 3){
                        bootbox.alert({
                        message: "Dispatcher already been taken for "+data.date+" schedule.",
                        centerVertical: true,
                        size: 'medium'
                        })
                    }else{
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
                    }
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