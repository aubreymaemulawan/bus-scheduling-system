@extends('layouts.app')
@section('title','Manage Accounts')

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
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password">
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
        <h1 class="h3 mb-2 text-gray-800">Dispatcher Account List</h1>
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
                                <th>Dispatcher</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daccount as $dp)
                                @if($dp->dispatcher->is_active==1)
                                <tr>
                                    <td>{{$dp->dispatcher->name}}</td>
                                    <td>{{$dp->email}}</td>
                                    <td>{{$dp->password}}</td>
                                    <td>
                                        <button  onclick="Edit({{ $dp->id }})" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
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
                $('#dispatcher_id').html('');
                $.ajax({
                    url: '{{ route('getDispatcher') }}?company_id='+companyId,
                    type: 'get',
                    success: function (res) {
                        $('#dispatcher_id').html('<option value="">Select Dispatcher</option>');
                        $.each(res, function (key, value) {
                            if(value.is_active == 1){
                                $('#dispatcher_id').append('<option value="' + value.id + '">'+ value.name +'</option>');
                            }
                        });
                    }
                });
            });
        });

        $('[id^="menu-"]').removeClass('active')
        $('#menu-daccount').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-dispatcher').addClass('active')
        $('#collapseDispatcher').addClass('show')

        var modal = '#main-modal';       
        
        function Error(){
            bootbox.alert({
            message: "Please check your Company List and activate status!",
            centerVertical: true,
            size: 'medium'
            })
        }

        function Add(){
            document.getElementById("header-modal").innerHTML="Account Information"
            document.getElementById("edit").innerHTML="Create"
            $('#id').val('-1'),
            $('#company_id').val(''),
            $('#dispatcher_id').val(''), $('#dispatcher_id').html(''),
            $('#email').val(''),
            $('#password').val(''),
            $(modal).modal(
                {'show':true}
            )
        }
        
        function Save() {
            var data = {
                id: $('#id').val(),
                dispatcher_id: $('#dispatcher_id').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            }
            if(data.id == -1) {
                Controller.Post('/api/daccount/create', data).done(function(result) {
                    Controller.Post('/api/dispatcher/items', { 'id': data.dispatcher_id }).done(function(result) {
                    var data2 = {
                        name: result.name,
                        dispatcher_id: data.dispatcher_id,
                        email: data.email,
                        password: data.password,
                        userType: 'dispatch',
                    }
                    Controller.Post('/api/user/create', data2).done(function(result) {});
                    });
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
                });
            }
            else if(data.id > 0) {
                Controller.Post('/api/daccount/update', data).done(function(result) {
                    Controller.Post('/api/dispatcher/items', { 'id': data.dispatcher_id }).done(function(result) {
                    var data2 = {
                        name: result.name,
                        dispatcher_id: data.dispatcher_id,
                        email: data.email,
                        password: data.password,
                        userType: 'dispatch',
                    }
                    Controller.Post('/api/user/update', data2).done(function(result) {});
                    });
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
            document.getElementById("company_id").setAttribute("disabled","disabled")
            document.getElementById("dispatcher_id").setAttribute("disabled","disabled")
            document.getElementById("header-modal").innerHTML="Edit Information"
            document.getElementById("edit").innerHTML="Save"
            Controller.Post('/api/daccount/items', { 'id': id }).done(function(result) {
                $('#id').val(result.id)
                $('#dispatcher_id').val(result.dispatcher_id),
                $('#email').val(result.email),
                $('#password').val(result.password),
                $(modal).modal({
                    'show': true
                })
            })
        }


    </script>
@endsection
