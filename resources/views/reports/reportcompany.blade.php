@extends('layouts.app')
@section('title','Companies Report')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Companies Report</h1>
        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="created_from">Created From</label>
                            <input name="created_from" type="month" class="form-control" id="created_from">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="created_to">Created To</label>
                            <input name="created_to" type="month" class="form-control" id="created_to">
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
        $('#menu-reportCompany').addClass('active')
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
                        $.ajax({
                            url: '{{ route('companyGenerate') }}?active='+isActive+'&from='+createdFrom+'&to='+createdTo,
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
                                    $('#crd').append('<h1 style="text-align:center" class="h3 mb-2 text-gray-800"> <strong>ADMIN COMPANIES REPORT</strong> </h1>');
                                    $('#crd').append('<p style="text-align:center" class="mb-3">Date : <strong>'+Date()+'</strong></p>');
                                    $('#crd').append('<br class="mb-4">');
                                    $('#crd').append('<hr class="mb-4">');
                                    $('#crd').append('<p class="mb-2">Date of Report : <strong style="color: #4e73df"> '+$('#created_from').val()+'-00 - '+$('#created_to').val()+'-31'+'</strong></p>');
                                    $('#crd').append('<p class="mb-2">Total Companies : <strong style="color: #4e73df">'+res.length+'</strong></p>');
                                    if(isActive == 1){ $('#crd').append('<p class="mb-2">Company Status : <strong style="color: #4e73df">Active Companies</strong></p>'); }
                                    else if(isActive == 2){ $('#crd').append('<p class="mb-2">Company Status : <strong style="color: #4e73df">Inactive Companies</strong></p>'); }
                                    else{ $('#crd').append('<p class="mb-2">Company Status : <strong style="color: #4e73df">Active & Inactive Companies</strong></p>'); }
                                    // Table Head
                                    $('#tble').append('<thead>'); 
                                    $('#tble').append('<tr>'); 
                                    $('#tble').append('<th>Company Name</th>');
                                    $('#tble').append('<th>Address</th>');
                                    $('#tble').append('<th>Description</th>');
                                    $('#tble').append('<th>Status</th>');
                                    $('#tble').append('<th>Created</th>');
                                    $('#tble').append('<th>Updated</th>');
                                    $('#tble').append('</tr>');
                                    $('#tble').append('</thead>');
                                    $.each(res, function (key, value) {
                                        // Table Values
                                        $('#tble').append('<tbody>');
                                        $('#tble').append('<tr>'); 
                                        $('#tble').append('<td>'+value.company_name+'</td>');
                                        $('#tble').append('<td>'+value.address+'</td>');
                                        $('#tble').append('<td>'+value.description+'</td>'); 
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
                                    
                                }
                            }
                        });                                   
                });
        });
        
        function generatePDF(){
            const output = document.getElementById('output');
            html2pdf().from(output).save('company-report.pdf');
        }

        // function generateEXCEL(type, fn, dl){
        //     const elt = document.getElementById('tble');
        //     var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"});
        //     return dl ?
        //         XLSX.write(wb, {bookType: type, bookSST:true, type: 'base64'}):
        //         XLSX.writeFile(wb, fn || ('CompanyReport.' + (type || 'xlsx')));
        // }
    </script>
@endsection