<!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
            </div>
            <div class="sidebar-brand-text mx-3">Admin Panel</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li id=main-dashboard class="nav-item">
            <a class="nav-link" href="./admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Interface
        </div>
        <!-- Bus Collapse Menu -->
        <li id=main-bus class="nav-item" >
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseBus"
                aria-expanded="true" aria-controls="collapseBus">
                <i class="fas fa-fw fa-bus"></i>
                <span>Manage Bus</span>
            </a>
            <div id="collapseBus" class="collapse" aria-labelledby="headingBus" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a id=menu-bus class="collapse-item" href="./bus">Manage Bus</a>
                    <a id=menu-company class="collapse-item" href="./company">Companies</a>
                    <a id=menu-location class="collapse-item" href="./location">Locations</a>
                    <a id=menu-route class="collapse-item" href="./route">Routes</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>
        <!-- Dispatcher Collapse Menu -->
        <li id=main-dispatcher class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseDispatcher"
                aria-expanded="true" aria-controls="collapseDispatcher">
                <i class="fas fa-fw fa-user"></i>
                <span>Manage Dispatcher</span>
            </a>
            <div id="collapseDispatcher" class="collapse" aria-labelledby="headingDispatcher" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a id=menu-dispatcher class="collapse-item" href="./dispatcher">Dispatcher List</a>
                    <a id=menu-daccount class="collapse-item" href="./daccount">Accounts</a>
                </div>
            </div>
        </li>
        <!-- Operator Menu -->
        <li id=main-operator class="nav-item">
            <a class="nav-link" href="./operator">
                <i class="fas fa-fw fa-id-card"></i>
                <span>Manage Operator</span></a>
        </li>
        <!-- Fare Menu -->
        <li id=main-fare class="nav-item">
            <a class="nav-link" href="./fare">
                <i class="fas fa-fw fa-ticket"></i>
                <span>Manage Fare</span></a>
        </li>
        <!-- Schedule Collapse Menu -->
        <li id=main-schedule class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseSchedule"
                aria-expanded="true" aria-controls="collapseSchedule">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Manage Schedule</span>
            </a>
            <div id="collapseSchedule" class="collapse" aria-labelledby="headingSchedule" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a id=menu-schedule class="collapse-item" href="./schedule">Schedule List</a>
                    <a id=menu-transaction class="collapse-item" href="./transaction">Transactions</a>
                </div>
            </div>
        </li>
        <!-- Trips Menu -->
        <li id=main-trip class="nav-item">
            <a class="nav-link" href="./trip">
                <i class="fas fa-fw fa- fa-map"></i>
                <span>Record of Trips</span></a>
        </li>
        <!-- Reports Collapse Menu -->
        <li id=main-report class="nav-item" >
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseReport"
                aria-expanded="true" aria-controls="collapseReport">
                <i class="fas fa-fw fa-file"></i>
                <span>Generate Reports</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a id=menu-reportBus class="collapse-item" href="./reportbus">Bus</a>
                    <a id=menu-reportCompany class="collapse-item" href="./reportcompany">Companies</a>
                    <a id=menu-reportDispatcher class="collapse-item" href="./reportdispatcher">Dispatchers</a>
                    <a id=menu-reportOperator class="collapse-item" href="./reportoperator">Operators</a>
                    <a id=menu-reportSchedule class="collapse-item" href="./reportschedule">Schedules</a>
                    <a id=menu-reportFare class="collapse-item" href="./reportfare">Fare</a>
                    <a id=menu-reportTransaction class="collapse-item" href="./reporttransaction">Transactions</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Websites
        </div>
        <!-- Website Menu -->
        <li id=main-website class="nav-item">
            <a class="nav-link" href="./">
                <i class="fas fa-fw fa-globe"></i>
                <span>Go to Website</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
<!-- End of Sidebar -->