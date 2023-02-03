@extends('layouts.app')
@section('title','Manage Fare')

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
                            <label for="route_id">Route</label>
                            <select name="route_id" class="form-control" data-style="btn btn-link" id="route_id">
                                @foreach ($route as $rt)
                                    <option value="{{ $rt->id }}">{{ $rt->from_to_location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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
                            <label for="price">Price</label>
                            <input name="price" type="number" class="form-control" id="price">
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
        <h1 class="h3 mb-2 text-gray-800">Fare List</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            @if(!$route->isEmpty())
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
                                <th>List No.</th>
                                <th>Route</th>
                                <th>Bus Type</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fare as $fr)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$fr->route->from_to_location}}</td>
                                <td>{{$fr->bustype->bus_type}}</td>
                                <td>₱ {{$fr->price}}</td>
                                <td>
                                    <button  onclick="Edit({{ $fr->id }})" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                </td>  
                                <td>
                                    <button onclick="Delete({{ $fr->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
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

        $('[id^="main"]').removeClass('active')
        $('#main-fare').addClass('active')

        var modal = '#main-modal';       
        
        function Error(){
            bootbox.alert({
                message: "Please check your Route List!",
                centerVertical: true,
                size: 'medium'
            });
        }

        function Add(){
            document.getElementById("header-modal").innerHTML="Fare Information"
            document.getElementById("edit").innerHTML="Create"
            $('#id').val('-1'),
            $('#route_id').val(''),
            $('#bustype_id').val(''),
            $('#price').val(''),
            $(modal).modal(
                {'show':true}
            )
        }
        
        function Save() {
            var data = {
            id: $('#id').val(),
            route_id: $('#route_id').val(),
            bustype_id: $('#bustype_id').val(),
            price: $('#price').val(),
            }
            if(data.id == -1) {
                Controller.Post('/api/fare/create', data).done(function(result) {
                    if(result == 1){
                        bootbox.alert({
                        message: "Route already been taken for selected bus type.",
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
                })
            }
            else if(data.id > 0) {
                Controller.Post('/api/fare/update', data).done(function(result) {
                    if(result == 1){
                        bootbox.alert({
                        message: "Route already been taken for selected bus type.",
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
            Controller.Post('/api/fare/items', { 'id': id }).done(function(result) {
                $('#id').val(result.id),
                $('#route_id').val(result.route_id),
                $('#bustype_id').val(result.bustype_id),
                $('#price').val(result.price),
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
                        Controller.Post('/api/fare/delete', { 'id': id }).done(function(result) {
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