@extends('layouts.app')
@section('title','Manage Bus')

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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bus_no">Bus No.</label>
                            <input name="bus_no" type="number" class="form-control" id="bus_no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bustype_id">Bus Type</label>
                            <select name="bustype_id" class="form-control" data-style="btn btn-link" id="bustype_id">
                                @foreach ($bustype as $bt)
                                    <option value="{{ $bt->id }}">{{ $bt->bus_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control" data-style="btn btn-link" id="company_id">
                                @foreach ($company as $comp)
                                    @if($comp->is_active==1)
                                        <option value="{{ $comp->id }}">{{ $comp->company_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plate_no">Plate Number</label>
                            <input name="plate_no" type="text" class="form-control" id="plate_no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="chassis_no">Chassis Number</label>
                            <input name="chassis_no" type="text" class="form-control" id="chassis_no">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="engine_no">Engine Number</label>
                            <input name="engine_no" type="text" class="form-control" id="engine_no">
                        </div>
                    </div>
                </div>
                <div id="status" class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" class="form-control" data-style="btn btn-link" id="is_active">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
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
        <h1 class="h3 mb-2 text-gray-800">Bus List</h1>
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
                                <th>Bus No.</th>
                                <th>Type</th>
                                <th>Company</th>
                                <th>Plate</th>
                                <th>Chassis</th>
                                <th>Engine</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bus as $buses)
                                @if($buses->company->is_active==1)
                                <tr>
                                    <td>{{$buses->bus_no}}</td>
                                    <td>{{$buses->bustype->bus_type}}</td>
                                    <td>{{$buses->company->company_name}}</td>
                                    <td>{{$buses->plate_no}}</td>
                                    <td>{{$buses->chassis_no}}</td>
                                    <td>{{$buses->engine_no}}</td>
                                    @if ($buses->is_active == 1)
                                    <td style="color:#1cc88a"><strong>Active</strong></td>
                                    @elseif ($buses->is_active == 2)
                                    <td style="color:#e74a3b"><strong>Inactive</strong></td>
                                    @endif
                                    <td>
                                        <button  onclick="Edit({{ $buses->id }})" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                    </td>  
                                    <td>
                                        <button onclick="Delete({{ $buses->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
        $(document).ready( 
            function () {
                $('#dataTable').DataTable();
            } 
        );

        $('[id^="menu-"]').removeClass('active')
        $('#menu-bus').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-bus').addClass('active')
        $('#collapseBus').addClass('show')

        var modal = '#main-modal';       
        
        function Error(){
            bootbox.alert({
                message: "Please check your Company List and activate status!",
                centerVertical: true,
                size: 'medium'
            });
        }

        function Add(){
            document.getElementById("header-modal").innerHTML="Bus Information"
            document.getElementById("edit").innerHTML="Create"
            $('#id').val('-1'),
            $('#bus_no').val(''),
            $('#company_id').val(''),
            $('#bustype_id').val(''),
            $('#plate_no').val(''),
            $('#chassis_no').val(''),
            $('#engine_no').val(''),
            $('#status').html(''),
            $(modal).modal(
                {'show':true}
            )
        }
        
        function Save() {
            var data1 = {
            id: $('#id').val(),
            bus_no: $('#bus_no').val(),
            company_id: $('#company_id').val(),
            bustype_id: $('#bustype_id').val(),
            plate_no: $('#plate_no').val(),
            chassis_no: $('#chassis_no').val(),
            engine_no: $('#engine_no').val(),
            is_active: 1,
            }
            var data2 = {
            id: $('#id').val(),
            bus_no: $('#bus_no').val(),
            company_id: $('#company_id').val(),
            bustype_id: $('#bustype_id').val(),
            plate_no: $('#plate_no').val(),
            chassis_no: $('#chassis_no').val(),
            engine_no: $('#engine_no').val(),
            is_active: $('#is_active').val(),
            }
            if(data1.id == -1) {
                Controller.Post('/api/bus/create', data1).done(function(result) {
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
            else if(data1.id > 0) {
                Controller.Post('/api/bus/update', data2).done(function(result) {
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
            Controller.Post('/api/bus/items', { 'id': id }).done(function(result) {
                $('#id').val(result.id)
                $('#bus_no').val(result.bus_no)
                $('#company_id').val(result.company_id)
                $('#bustype_id').val(result.bustype_id)
                $('#plate_no').val(result.plate_no)
                $('#chassis_no').val(result.chassis_no),
                $('#engine_no').val(result.engine_no),
                $('#is_active').val(result.is_active),
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
                        Controller.Post('/api/bus/delete', { 'id': id }).done(function(result) {
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