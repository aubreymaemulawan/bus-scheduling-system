<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('pub/img/logo.svg')}}" />
 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>
            @yield('title') | BSATS
        </title>

        <!-- Fonts -->
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- CSS Styles -->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">

        <!-- CSS Data Table Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
    </head>

    <body>
            @guest
                @if (Route::has('login'))
                    <main class="py-4">
                        @yield('login_content')
                        <div class="copyright text-center my-auto" >
                            <span> Copyright &copy; Bus Scheduling System 2022</span>
                        </div>
                    </main>
                @endif
                @else
                    @if( Auth::user()->userType == 'admin')
                        @yield('modal')
                        <!-- Page Wrapper -->
                        <div id="wrapper">
                            @include('admin.sidebar')
                            <!-- Content Wrapper -->
                            <div id="content-wrapper" class="d-flex flex-column">
                                <!-- Main Content -->
                                <div id="content">
                                    @include('admin.navbar')
                                    @yield('content')
                                </div>
                                <!-- End of Main Content -->  
                                @include('admin.footer')
                            </div>
                            <!-- End of Content Wrapper -->
                        </div>
                        <!-- End of Page Wrapper -->
                    @elseif( Auth::user()->userType == 'dispatch')
                        @yield('modal')
                        <!-- Page Wrapper -->
                        <div id="wrapper">
                            @include('dispatch.sidebar')
                            <!-- Content Wrapper -->
                            <div id="content-wrapper" class="d-flex flex-column">
                                <!-- Main Content -->
                                <div id="content">
                                    @include('dispatch.navbar')
                                    @yield('dispatch_content')
                                </div>
                                <!-- End of Main Content -->  
                                @include('dispatch.footer')
                            </div>
                            <!-- End of Content Wrapper -->
                        </div>
                        <!-- End of Page Wrapper -->
                    @endif
            @endguest

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/script.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

    <!-- Data Table scripts -->
    <script type="text/javascript" charset="utf8" src="{{asset('js/datatables.js')}}"></script>    

    <!-- Bootbox scripts -->
    <script src="{{ asset('vendor/bootbox/assets/js/bootbox.min.js')}}"></script>

    <!-- POST & GET Request scripts -->
    <script src="{{ asset('js/core.js') }}"></script>
    
    <!-- Download HTML to PDF scripts -->
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

    <!-- Download HTML to PDF scripts -->
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>

    @yield('scripts')
    </body>
</html>
