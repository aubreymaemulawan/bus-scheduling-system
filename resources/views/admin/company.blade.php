@extends('layouts.app')
@section('title','Manage Companies')

@section('modal')
    <!-- Adding New Data -->
        <div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <form enctype="multipart/form-data" id="image-upload" >
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#4e73df">
                        <h5 id="header-modal" class="modal-title" id="main-modalLabel" style="color:white;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input name="company_name" type="text" class="form-control" id="company_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input name="address" type="text" class="form-control" id="address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Short Description</label>
                                <input name="description" type="text" class="form-control" id="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="logo">Company Logo</label>
                                <input name="logo" type="file" class="form-control" id="logo">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary" style="background-color:#4e73df">Create</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <!-- End of Adding Modal -->


    <!-- Updating Old Data -->
        <div class="modal fade" id="edit-main-modal" tabindex="-1" role="dialog" aria-labelledby="edit-main-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <form enctype="multipart/form-data" id="edit-image-upload" >
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#4e73df">
                        <h5 id="edit-header-modal" class="modal-title" id="edit-main-modalLabel" style="color:white;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                    <input type="hidden" name="edit-id" class="form-control" id="edit-id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="avatar avatar-xl position-relative">
                                <img id="img" src="{{ asset('pub/img/default.jpg') }}" alt="profile_image" class="css-shadow center shadow-4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-company_name">Company Name</label>
                                <input name="edit-company_name" type="text" class="form-control" id="edit-company_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-address">Address</label>
                                <input name="edit-address" type="text" class="form-control" id="edit-address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-description">Short Description</label>
                                <input name="edit-description" type="text" class="form-control" id="edit-description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-logo">Company Logo</label>
                                <input name="edit-logo" type="file" class="form-control" id="edit-logo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-is_active">Status</label>
                                <select name="edit-is_active" class="form-control" data-style="btn btn-link" id="edit-is_active">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary" style="background-color:#4e73df">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <!-- End of Updating Data -->
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Company List</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button onclick="Add()" type="button" class="btn btn-sm btn btn-success">Add New</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $company)
                            <tr>
                                <td>
                                    @if($company->logo_path=="")
                                        <img src="{{ asset('pub/img/default2.png') }}" width="50" height="50" class="css-shadow2 center shadow-4">
                                    @else
                                        <?php
                                            $str = $company->logo_path;
                                            $str = ltrim($str, 'public/');
                                        ?>
                                        <img src="{{ asset('../storage/'.$str) }}" width="50" height="50" class="css-shadow2 center shadow-4">
                                    @endif
                                </td>
                                <td>{{$company->company_name}}</td>
                                <td>{{$company->address}}</td>
                                <td>{{$company->description}}</td>
                                @if ($company->is_active == 1)
                                <td style="color:#1cc88a"><strong>Active</strong></td>
                                @elseif ($company->is_active == 2)
                                <td style="color:#e74a3b"><strong>Inactive</strong></td>
                                @endif
                                </td>
                                <td>
                                    @if($company->logo_path==null)
                                    <button onclick="Edit({{ $company->id }},document.getElementById('img').src='{{ asset('pub/img/default2.png') }}')" class="btn btn-sm btn-warning "><i class="fa fa-pencil"></i></button>
                                    @else
                                    <button onclick="Edit({{ $company->id }},document.getElementById('img').src='{{ asset('../storage/'.$str) }}')" class="btn btn-sm btn-warning "><i class="fa fa-pencil"></i></button>
                                    @endif
                                </td>  
                                <td>
                                    <button onclick="Delete({{ $company->id }})" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></button>
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
            function (e) {
                $('#dataTable').DataTable();
                // Add/Create Data
                $(document).on('submit','#image-upload', function(e) {
                    e.preventDefault();
                    let addformData = new FormData($('#image-upload')[0]);
                        $.ajax(
                            {
                                type:'POST',
                                url: "{{ url('/api/company/create') }}",
                                data: addformData,
                                cache: false,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: (data) => {
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
                                },
                                error: function(data){
                                console.log(data);
                                }
                            }
                        );
                    }
                );
                // Update/Edit Data
                $(document).on('submit','#edit-image-upload', function(e) {
                    e.preventDefault();
                    let editformData = new FormData($('#edit-image-upload')[0]);
                        $.ajax(
                            {
                                type:'POST',
                                url: "{{ url('/api/company/update') }}",
                                data: editformData,
                                cache: false,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    var dialog = bootbox.dialog({
                                        centerVertical: true,
                                        title: 'Updating Information',
                                        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
                                    });
                                    $('#edit-main-modal').modal('hide');
                                    dialog.init(function(){
                                        setTimeout(function(){
                                            dialog.find('.bootbox-body').html('Information Successfully updated!');
                                            window.location.reload();
                                        }, 3000);
                                        
                                    });
                                },
                                error: function(data){
                                console.log(data);
                                }
                            }
                        );
                    }
                );                
            } 
        );
        
        $('[id^="menu-"]').removeClass('active')
        $('#menu-company').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-bus').addClass('active')
        $('#collapseBus').addClass('show')
        
        function Add(){
            document.getElementById("header-modal").innerHTML="Company Information"
            $('#id').val('-1'),
            $('#company_name').val(''),
            $('#address').val(''),
            $('#description').val(''),
            $('#logo').val(''),
            $('#is_active').val(''),
            $('#main-modal').modal(
                {'show':true}
            )
        }

        function Edit(id) {
            document.getElementById("edit-header-modal").innerHTML="Edit Information"
            Controller.Post('/api/company/items', { 'id': id }).done(function(result) {
                $('#edit-id').val(result.id)
                $('#edit-company_name').val(result.company_name)
                $('#edit-address').val(result.address)
                $('#edit-description').val(result.description)
                $('#edit-logo').val(result.logo)
                $('#edit-is_active').val(result.is_active),
                $('#edit-main-modal').modal({
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
                        Controller.Post('/api/company/delete', { 'id': id }).done(function(result) {
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