@extends('layouts.app')
@section('title','Dispatch Trip')

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" data-style="btn btn-link" id="status">
                                @foreach ($busstatus as $bs)
                                    <option value="{{$bs->id}}">{{ $bs->bus_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>
                <div class="modal-footer">
                    <button id="close" onclick="Close()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="edit" onclick="Save()" type="button" class="btn btn-primary" style="background-color:#4e73df"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="trans-modal" tabindex="-1" role="dialog" aria-labelledby="trans-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df">
                    <h5 id="header-modal1" class="modal-title" id="trans-modalLabel" style="color:white;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <select name="price" class="form-control" data-style="btn btn-link" id="price">
                                <option selected="true" value="123">₱ 123.00</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="passengers">No. of Passengers</label>
                            <input name="passengers" type="number" class="form-control" id="passengers">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="total" class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button id="close" onclick="Calculate1()" type="button" class="btn btn-secondary" style="background-color:#1cc88a">Calculate</button>
                    <button id="edit1" onclick="Save1()" type="button" class="btn btn-primary" style="background-color:#4e73df"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dispatch_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Trip Number : 1</h1>
        <h3 class="h5 mb-2 text-gray-800">Agora - Laguindingan</h3>
        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group genrep">
                            <button onclick="dropdown()" id="busstatus" type="button" class="form-control btn btn-sm btn btn-primary">Set Trip Status</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group genrep">
                            <button onclick="transact()" id="generate" type="button" class="form-control btn btn-sm btn btn-primary">Add Trip Transaction</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group genrep">
                        <a href="./dispatch-transaction"><button onclick="mod()" id="generate" type="button" class="form-control btn btn-sm btn btn-success">Trip Finished</button></a>

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
                    <div class="card-header py-3">
                        <h5 id="name_head" class="h6 mb-2 text-gray-800">Trip Status Logs</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Trip No.</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection
 
@section('scripts')
    <script>
    var modal = '#main-modal';  
    var trans = '#trans-modal';     
    function dropdown(){
        document.getElementById("header-modal").innerHTML="Bus Status"
        document.getElementById("edit").innerHTML="Set"
        $('#status').val('-1'),
        $(modal).modal(
            {'show':true}
        )
    }
    function Save(){
        $('#main-modal').modal('hide');
        $('#dataTable').append('<tbody>');
        $('#dataTable').append('<tr>'); 
        $('#dataTable').append('<td>1</td>');
        $('#dataTable').append('<td>2022-05-30 | 8:00:01</td>'); 
        $('#dataTable').append('<td>Loading Passenger</td>'); 
        $('#dataTable').append('<td>Cagayan de Oro City</td>'); 
        $('#dataTable').append('</tr>');
        $('#dataTable').append('</tbody>'); 
    }
    function mod(){
        bootbox.alert({
            message: "Trip No 1 has successfully ended!",
            centerVertical: true,
            size: 'medium',
        }); 
    }
    function transact(){
        $('#passengers').val('')
        $('#total').html('');
        document.getElementById("header-modal1").innerHTML="Bus Transaction"
        document.getElementById("edit1").innerHTML="Save"
        $(trans).modal(
            {'show':true}
        )
    }
    function Calculate1(){
        $('#total').html('');
        pr = $('#price').val()
        pass = $('#passengers').val()
        sum = parseInt(pr)*parseInt(pass)
        $('#total').append('<label>Total: ₱ '+sum+'</label>');
    }
    function Save1(){
        $(trans).modal('hide')
        var dialog = bootbox.dialog({
            centerVertical: true,
            title: 'Saving Information',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
        });
        dialog.init(function(){
            setTimeout(function(){
                dialog.find('.bootbox-body').html('Transaction Successfully saved!');
                bootbox.hideAll();
            }, 1000);
        });
    }
    </script>
@endsection
 
