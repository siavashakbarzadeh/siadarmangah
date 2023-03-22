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
                <h1 class="h3 mb-2 text-gray-800">Soci eliminati</h1>


                <!-- Lista soci -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{route('new-member')}}"> <h6 class="m-0 font-weight-bold text-primary text-right">Aggiungi Socio <span> <i class="fas fa-user-plus"></i> </span> </h6>   </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Codice Fiscale</th>
                                    <th>Email</th>
                                    <th>Ripristina</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Codice Fiscale</th>
                                    <th>Email</th>
                                    <th>Ripristina</th>
                                    <th>Elimina</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                @foreach($members as $member)
                                    <tr>
                                        <td>{{$member->name}} {{$member->surname}}</td>
                                        <td>{{$member->fiscal_code}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>
                                            @can('add-member')
                                            <form action="{{route('member-restore', $member->id)}}" method="post">@csrf <button type="submit" class="btn btn-success">Ripristina</button> </form>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('add-member')
                                            <form action="{{route('member-hard-delete', $member->id)}}" method="post">@csrf <button type="submit" class="btn btn-danger">Elimina definitivamente</button> </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PAGINATION -->
                {{$members->links()}}



            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>SidSoci</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
@include('common.footer')
