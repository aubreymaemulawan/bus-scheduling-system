@extends('layouts.app')
@section('title','Trip Records')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Trip Records</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Route</th>
                                <th>Discount</th>
                                <th>No. of Passengers</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
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
        $('#menu-transaction').addClass('active')
        $('[id^="main"]').removeClass('active')
        $('#main-schedule').addClass('active')
        $('#collapseSchedule').addClass('show')

    </script>
@endsection
