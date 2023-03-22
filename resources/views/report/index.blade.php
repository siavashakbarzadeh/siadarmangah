@include('common.header')
<!-- Page Wrapper -->
<div id="wrapper">

   @include('common.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Top bar -->
            @include('common.topbar')


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>


                <!-- Content Row -->
                <h6 class="font-weight-bold text-primary">Statistiche soci</h6>
                <div class="row mt-4">

                    <!-- Area Chart -->
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Soci ordinari
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                        {{$stats['ordinary']}}
                                            <br>
                                            @can('add-payment')
                                            @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Partecipanti ECM
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{$stats['ecm']}}
                                            <br>
                                            @can('add-payment')
                                            @livewire('export', ['type' => $types['member_type'][1], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Soci YoSid
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{$stats['yosid']}}
                                            <br>
                                            @can('add-payment')
                                            @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][1],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Under 40
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{$stats['under40']}}
                                            <br>
                                            @can('add-payment')
                                            @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][1]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">

                    <!-- Area Chart -->
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Situazione contabile soci
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @can('add-payment')
                                                @livewire('accountability')
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Autorizzazioni mancanti
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export-auth')
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Soci Sospesi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][1],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Elenco tipologia soci
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][1]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">

                    <!-- Area Chart -->
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Consigli direttivi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Presidenti regionali
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][1], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Gruppi di studio
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][1],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Comitati Scientifici
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][1]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">

                    <!-- Area Chart -->
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Commissioni
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Saldo soci per regioni
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            @can('add-payment')
                                                @livewire('export', ['type' => $types['member_type'][1], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
<span>SID Soci</span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>


@include('common.footer')
