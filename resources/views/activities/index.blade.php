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
                <h1 class="h3 mb-2 text-gray-800">Lista attività</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row mt-3 mb-3">

                        </div>
                        <div id="table-container" class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Attività</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->description}}</td>
                                        <td>{{\Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s')}}</td>
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
</div>
@include('common.footer')

