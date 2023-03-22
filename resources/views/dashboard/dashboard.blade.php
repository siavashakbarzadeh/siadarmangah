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

                <h6 class="mt-4 font-weight-bold text-primary">Report contabili</h6>
                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary mb-1">
                                            Pagamenti per l'anno {{\Carbon\Carbon::now()->format('Y')}}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            €{{$stats['payments']}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Categorie</h6>
                            </div>
                            <div class="card-body">
                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Totale</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categoryStats as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$value}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Soci Junior</h6>
                            </div>
                            <div class="card-body">

                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Totale</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($yoSidStats as $key => $value)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$value}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Professioni</h6>
                            </div>
                            <div class="card-body">
                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Professione</th>
                                            <th>Totale</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($professionsStats as $key => $value)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$value}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Discipline</h6>
                            </div>
                            <div class="card-body">
                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Disciplina</th>
                                            <th>Totale</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($disciplinesStats as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$value}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
