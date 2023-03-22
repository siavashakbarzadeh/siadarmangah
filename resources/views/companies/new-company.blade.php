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
                <h1 class="h3 mb-2 text-gray-800">Dettaglio sponsor</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">

                    </div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{route('company-store')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Nome</label>
                                        <input class="form-control" type="text"  name="companyName">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="form-label">Indirizzo</label>
                                        <input class="form-control" type="text" name="address">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="code" class="form-label">Codice</label>
                                        <input class="form-control" type="text"  name="code">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Città</label>
                                        <input class="form-control" type="text"  name="city">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telephone1" class="form-label">Telefono</label>
                                        <input class="form-control" type="text"  name="telephone1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telephone2" class="form-label">Telefono secondario</label>
                                        <input class="form-control" type="text"  name="telephone2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary">Salva</button>
                                    </div>
                                </div>
                            </form>
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
