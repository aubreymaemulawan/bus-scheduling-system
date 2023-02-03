@extends('layouts.app')
@section('title','Bus Report')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bus Report</h1>
        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="created_from">Created From</label>
                            <input name="created_from" type="month" class="form-control" id="created_from">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="created_to">Created To</label>
                            <input name="created_to" type="month" class="form-control" id="created_to">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control" data-style="btn btn-link" id="company_id">
                                <option value="0">All Company</option>
                                @foreach ($company as $comp)
                                    <option value="{{ $comp->id }}">{{ $comp->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" class="form-control" data-style="btn btn-link" id="is_active">
                                <option value="0">All Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group genrep">
                            <button id="generate" type="button" class="form-control btn btn-sm btn btn-success">Generate Report</button>
                        </div>
                    </div>
                    <div class="col-md-12" id="gen-button">
                        <div class="form-group" >
                        </div>
                    </div>
                </div>                
            </div>
            <div class="card-body" id="output">
                <div id="crd">
                </div>
                <div class="table-responsive">
                    <table id="tble" class="table" width="100%" cellspacing="0">
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection
 
@section('scripts')
    <script>
        $('[id^="menu-"]').removeClass('active')
        $('#menu-reportBus').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-report').addClass('active')
        $('#collapseReport').addClass('show')

        $('#report_from').val('')
        $('#report_to').val('')
        $('#company_id').val('')
        $('#is_active').val('')

        $(document).ready( 
            function () {  
                $('#generate').on('click', function () {
                    $('#tble').html('');
                    $('#crd').html('');
                    $('#gen-button').html('');
                        var createdFrom = $('#created_from').val()+'-00 00:00:00';
                        var createdTo = $('#created_to').val()+'-31 23:59:59';
                        var isActive = $('#is_active').val();
                        var companyId = $('#company_id').val();
                        $.ajax({
                            url: '{{ route('busGenerate') }}?active='+isActive+'&company='+companyId+'&from='+createdFrom+'&to='+createdTo,
                            type: 'get',
                            success: function (res) {
                                if(res === 0){
                                    bootbox.alert({
                                        message: "No Data Found!",
                                        centerVertical: true,
                                        size: 'medium'
                                    }); 
                                }else{
                                    // PDF & EXCEL Button
                                    $('#gen-button').append('<a onclick="generatePDF()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> PDF</a>');
                                    $('#gen-button').append('<a> </a>');
                                    $('#gen-button').append('<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> EXCEL</a>');
                                    // Title & About
                                    $('#crd').append('<br class="mb-4">');
                                    $('#crd').append('<img src="{{ asset('pub/img/logo.svg') }}" width="40" height="40" class="center shadow-4 mb-3">');
                                    $('#crd').append('<h1 style="text-align:center" class="h3 mb-2 text-gray-800"> <strong>ADMIN BUS REPORT</strong> </h1>');
                                    $('#crd').append('<p style="text-align:center" class="mb-3">Date : <strong>'+Date()+'</strong></p>');
                                    $('#crd').append('<br class="mb-4">');
                                    $('#crd').append('<hr class="mb-4">');
                                    $('#crd').append('<p class="mb-2">Date of Report : <strong style="color: #4e73df"> '+$('#created_from').val()+'-00 - '+$('#created_to').val()+'-31'+'</strong></p>');
                                    $('#crd').append('<p class="mb-2">Total Buses : <strong style="color: #4e73df">'+res.length+'</strong></p>');
                                    if(isActive == 1){ $('#crd').append('<p class="mb-2">Bus Status : <strong style="color: #4e73df">Active Buses</strong></p>'); }
                                    else if(isActive == 2){ $('#crd').append('<p class="mb-2">Bus Status : <strong style="color: #4e73df">Inactive Buses</strong></p>'); }
                                    else{ $('#crd').append('<p class="mb-2">Bus Status : <strong style="color: #4e73df">Active & Inactive Buses</strong></p>'); }
                                    if(companyId == 0){
                                        $('#crd').append('<p class="mb-4">Company : <strong style="color: #4e73df">All Companies</strong></p>');
                                    }else{
                                        Controller.Post('/api/company/items', { 'id': companyId }).done(function(result) {
                                            $('#crd').append('<p class="mb-4">Company : <strong style="color: #4e73df">'+result.company_name+'</strong></p>');
                                        });
                                    }
                                    // Table Head
                                    $('#tble').append('<thead>'); 
                                    $('#tble').append('<tr>'); 
                                    $('#tble').append('<th>Company</th>');
                                    $('#tble').append('<th>Bus No.</th>');
                                    $('#tble').append('<th>Bus Type</th>');
                                    $('#tble').append('<th>Plate No.</th>');
                                    $('#tble').append('<th>Chassis No.</th>');
                                    $('#tble').append('<th>Engine No.</th>');
                                    $('#tble').append('<th>Status</th>');
                                    $('#tble').append('<th>Created</th>');
                                    $('#tble').append('<th>Updated</th>');
                                    $('#tble').append('</tr>');
                                    $('#tble').append('</thead>');
                                    $.each(res, function (key, value) {
                                        // Table Values
                                        Controller.Post('/api/company/items', { 'id': value.company_id }).done(function(result) {                                        
                                        $('#tble').append('<tbody>');
                                        $('#tble').append('<tr>'); 
                                        $('#tble').append('<td>'+result.company_name+'</td>');
                                        $('#tble').append('<td>'+value.bus_no+'</td>'); 
                                        if(value.bustype_id == 1){
                                            $('#tble').append('<td>AC</td>');
                                        }else if(value.bustype_id == 2){
                                            $('#tble').append('<td>NAC</td>');
                                        }
                                        $('#tble').append('<td>'+value.plate_no+'</td>'); 
                                        $('#tble').append('<td>'+value.chassis_no+'</td>'); 
                                        $('#tble').append('<td>'+value.engine_no+'</td>'); 
                                        if(value.is_active == 1){
                                            $('#tble').append('<td style="color:#1cc88a"><strong>Active</strong></td>');
                                        }else if(value.is_active == 2){
                                            $('#tble').append('<td style="color:#e74a3b"><strong>Inactive</strong></td>');
                                        }
                                        $('#tble').append('<td>'+value.created_at+'</td>'); 
                                        $('#tble').append('<td>'+value.updated_at+'</td>'); 
                                        $('#tble').append('</tr>');
                                        $('#tble').append('</tbody>'); 
                                    });
                                    });
                                    
                                }
                            }
                        });                                   
                });
        });
        
        function generatePDF(){
            const output = document.getElementById('output');
            html2pdf().from(output).save('bus-report.pdf');
        }
    </script>
@endsection