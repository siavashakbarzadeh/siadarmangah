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
                <h1 class="h3 mb-2 text-gray-800">Apertura anno</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">

                        <div id="table-container" class="table-responsive">

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <form action="{{route('add-quotas')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Apertura anno</button>
                                    </form>
                                </div>
                            </div>
                            @if($failedQuotas->isEmpty())
                            <p>Buone notizie, la lista degli errori è vuota</p>
                            @else
                            <p>Ai seguenti soci non è stata aggiunta la quota annuale</p>
                            @endif
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id Socio</th>
                                    <th>Cognome</th>
                                    <th>Nome</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($failedQuotas as $quota)
                                    <tr>{{$member->id}}</tr>
                                    <tr>{{$member->payment_date}}</tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
@include('common.footer')
