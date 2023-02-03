@extends('layouts.app')
@section('title','Manage Routes')

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
                            <label for="orig_location">Origin Location</label>
                            <select name="orig_location" class="form-control" data-style="btn btn-link" id="orig_location"> 
                            <?php $location1 = DB::table('location')->select('place')->get(); ?>
                            @foreach ($location1 as $value1)
                                <option value="{{ $value1->place }}">{{ $value1->place }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dest_location">Destination Location</label>
                            <select name="dest_location" class="form-control" data-style="btn btn-link" id="dest_location"> 
                            <?php $location2 = DB::table('location')->select('place')->get(); ?>
                            @foreach ($location2 as $value2)
                                <option value="{{ $value2->place }}">{{ $value2->place }}</option>
                            @endforeach
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
        <h1 class="h3 mb-2 text-gray-800">Route List</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <?php $location = DB::table('location')->get(); ?>
            @if(!$location->isEmpty())
                <button onclick="Add()" type="button" class="btn btn-sm btn btn-success">Add New</button>
            @else
                <button onclick="Error1()" type="button" class="btn btn-sm btn btn-success">Add New</button>
            @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>List No.</th>
                                <th>Route</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $route)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$route->from_to_location}}</td>
                                <td>
                                    <button  onclick="Edit({{ $route->id }})" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                </td>  
                                <td>
                                    <button onclick="Delete({{ $route->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

        $('[id^="menu-"]').removeClass('active')
        $('#menu-route').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-bus').addClass('active')
        $('#collapseBus').addClass('show')

        var modal = '#main-modal';       
        
        function Error(){
            bootbox.alert({
                message: "Invalid Input!",
                centerVertical: true,
                size: 'medium'
            });
        }
        function Error1(){
            bootbox.alert({
                message: "Please check your Location List!",
                centerVertical: true,
                size: 'medium'
            });
        }

        function Add(){
            document.getElementById("header-modal").innerHTML="Route Information"
            document.getElementById("edit").innerHTML="Create"
            $('#id').val('-1'),
            $('#orig_location').val(''),
            $('#dest_location').val(''),
            $(modal).modal(
                {'show':true}
            )
        }
        
        function Save() {
            var orig_location = $('#orig_location').val();
            var dest_location = $('#dest_location').val();
            var data = {
            id: $('#id').val(),
            from_to_location: orig_location+' - '+dest_location,
            }
            if(orig_location == dest_location){
                Error();
            }else if(data.id == -1) {
                Controller.Post('/api/route/create', data).done(function(result) {
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
                Controller.Post('/api/route/update', data).done(function(result) {
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
            Controller.Post('/api/route/items', { 'id': id }).done(function(result) {
                $('#id').val(result.id),                
                $('#orig_location').val((result.from_to_location).split(' - ')[0]),
                $('#dest_location').val((result.from_to_location).split(' - ')[1]),
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
                        Controller.Post('/api/route/delete', { 'id': id }).done(function(result) {
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