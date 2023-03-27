<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center brand" href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3"> <img class="img-responsive" src="{{asset('img/logosid.png')}}"> </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('report')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tutti i report</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestione Soci
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMembers"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Anagrafica</span>
        </a>
        <div id="collapseMembers" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6>-->
                <a class="collapse-item" href="{{route('member')}}">Soci SID</a>
                <a class="collapse-item" href="{{route('ecm-member')}}">Partecipanti ECM</a>
                <a class="collapse-item" href="{{route('deleted-member')}}">Soci eliminati</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayments"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Contabilità</span>
        </a>
        <div id="collapsePayments" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6>-->
                <a class="collapse-item" href="{{route('payment-history')}}">Storico Pagamenti</a>
                <a class="collapse-item" href="{{route('members-payment')}}">Registrazione pagamenti</a>
{{--                @can('open-year')--}}
                <a class="collapse-item" href="{{route('new-year-payments')}}">Apertura anno</a>
{{--                @endcan--}}
{{--                @can('send-quota')--}}
                <a class="collapse-item" href="{{route('quota-list')}}">Invio quote</a>
{{--                @endcan--}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-database"></i>
            <span>Report</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
{{--                @can('add-payment')--}}
                    <a class="collapse-item" href="{{route('dashboard')}}">Statistiche</a>
{{--                @endcan--}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestione corsi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-university"></i>
            <span>Corsi</span>
        </a>
        <div id="collapseCourses" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6>-->
                <a class="collapse-item" href="{{route('course-list')}}">Lista corsi</a>
                <a class="collapse-item" href="{{route('companies-list')}}">Sponsor</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
