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
                                <th>Date</th>
                                <th>Trip No.</th>
                                <th>Duration</th>
                                <th>Status</th>
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

        $('[id^="main"]').removeClass('active')
        $('#main-trip').addClass('active')

    </script>
@endsection
