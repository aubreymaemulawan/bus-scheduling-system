@extends('layouts.app')
@section('title','Trip Transaction Records')

@section('dispatch_content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Trip Transaction Records</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Bus No.</th>
                                <th>Trip No.</th>
                                <th>No. of Passengers</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2022-05-30</td>
                                <td>121 - AC</td>
                                <td>1</td>
                                <td>100</td>
                                <td>₱ 7,000</td>
                                <td>Arrived</td>
                            </tr>
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
        $('#main-transaction').addClass('active')

    </script>
@endsection
