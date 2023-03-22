@include('common.header')
<!-- Page Wrapper -->
<div id="wrapper">
    <meta name="_token" content="{{ csrf_token() }}">
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
                    <h1 class="h3 mb-0 text-gray-800">Impostazioni</h1>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 mb-4">
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">SMTP</h6>
                        </div>
                        <div class="card-body">
                            <label>Mittente</label>
                            <input class="form-control mb-3" readonly value="{{$email}}">
                            <label>Nome mittente</label>
                            <input class="form-control mb-3" readonly value="{{$name}}">
                            <label>Host</label>
                            <input class="form-control mb-3" readonly value="{{$host}}">
                            <label>Porta</label>
                            <input class="form-control mb-3" readonly value="{{$port}}">
                            <label>Crittografia</label>
                            <input class="form-control mb-3" readonly value="{{$encryption}}">

                            <form method="POST" action="{{route('send-test-email')}}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Invia email di test</button>
                            </form>
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
<span>Copyright &copy; Your Website 2021</span>
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

<script src="{{asset('js/settings.js')}}"></script>
@include('common.footer')
