@extends('layouts.app')
@section('title','Schedule Report')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Schedule Report</h1>
        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_from">Schedule From</label>
                            <input name="schedule_from" type="date" class="form-control" id="schedule_from">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_to">Schedule To</label>
                            <input name="schedule_to" type="date" class="form-control" id="schedule_to">
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
        $('#menu-reportSchedule').addClass('active')
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
                        var scheduleFrom = $('#schedule_from').val();
                        var scheduleTo = $('#schedule_to').val();
                        var isActive = $('#is_active').val();
                        var companyId = $('#company_id').val();
                        $.ajax({
                            url: '{{ route('scheduleGenerate') }}?active='+isActive+'&company='+companyId+'&from='+scheduleFrom+'&to='+scheduleTo,
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
                                    $('#crd').append('<h1 style="text-align:center" class="h3 mb-2 text-gray-800"> <strong>ADMIN SCHEDULE REPORT</strong> </h1>');
                                    $('#crd').append('<p style="text-align:center" class="mb-3">Date : <strong>'+Date()+'</strong></p>');
                                    $('#crd').append('<br class="mb-4">');
                                    $('#crd').append('<hr class="mb-4">');
                                    $('#crd').append('<p class="mb-2">Date of Report : <strong style="color: #4e73df"> '+$('#schedule_from').val()+'-00 - '+$('#schedule_to').val()+'-31'+'</strong></p>');
                                    $('#crd').append('<p class="mb-2">Total Schedules : <strong style="color: #4e73df">'+res.length+'</strong></p>');
                                    if(isActive == 1){ $('#crd').append('<p class="mb-2">Schedule Status : <strong style="color: #4e73df">Active Schedules</strong></p>'); }
                                    else if(isActive == 2){ $('#crd').append('<p class="mb-2">Schedule Status : <strong style="color: #4e73df">Inactive Schedules</strong></p>'); }
                                    else{ $('#crd').append('<p class="mb-2">Schedule Status : <strong style="color: #4e73df">Active & Inactive Schedules</strong></p>'); }
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
                                    $('#tble').append('<th>Date</th>');
                                    $('#tble').append('<th>Company</th>');
                                    $('#tble').append('<th>Bus No.</th>');
                                    $('#tble').append('<th>Route</th>');
                                    $('#tble').append('<th>Operator</th>');
                                    $('#tble').append('<th>Dispatcher</th>');
                                    $('#tble').append('<th>Trip</th>');
                                    $('#tble').append('<th>Interval</th>');
                                    $('#tble').append('<th>Status</th>');
                                    $('#tble').append('<th>Created</th>');
                                    $('#tble').append('<th>Updated</th>');
                                    $('#tble').append('</tr>');
                                    $('#tble').append('</thead>');
                                    $.each(res, function (key, value) {
                                        // Table Values
                                        Controller.Post('/api/company/items', { 'id': value.company_id }).done(function(result) {   
                                        Controller.Post('/api/bus/items', { 'id': value.bus_id }).done(function(result2) {
                                        Controller.Post('/api/route/items', { 'id': value.route_id }).done(function(result3) {
                                        Controller.Post('/api/operator/items', { 'id': value.operator_id }).done(function(result4) {
                                        Controller.Post('/api/dispatcher/items', { 'id': value.dispatcher_id }).done(function(result5) {                                        
                                        $('#tble').append('<tbody>');
                                        $('#tble').append('<tr>'); 
                                        $('#tble').append('<td>'+value.date+'</td>');
                                        $('#tble').append('<td>'+result.company_name+'</td>');
                                        if(result2.bustype_id == 1){
                                            $('#tble').append('<td>'+result2.bus_no+' - Airconditioned</td>');
                                        }else if(result2.bustype_id == 2){
                                            $('#tble').append('<td>'+result2.bus_no+' - Non-Airconditioned</td>');
                                        }
                                        $('#tble').append('<td>'+result3.orig_location+' - '+result3.dest_location+'</td>'); 
                                        $('#tble').append('<td>'+result4.name+'</td>'); 
                                        $('#tble').append('<td>'+result5.name+'</td>'); 
                                        $('#tble').append('<td> <strong>First Trip: </strong>'+value.first_trip+' <strong>Last Trip: </strong>'+value.last_trip+' <strong>Max: </strong>'+value.max_trips+'</td>'); 
                                        $('#tble').append('<td>'+value.interval_mins+' mins</td>');
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
                                });
                            });
                        });
                                });
                                    
                                }
                            }
                        });                                   
                });
        });
        
        function generatePDF(){
            const output = document.getElementById('output');
            const opt = {
                filename: 'schedule-report.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, logging: true, letterRendering: true, useCORS: true},
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' },
            };
            html2pdf().set(opt).from(output).toPdf().save();
        };
        
    </script>
@endsection