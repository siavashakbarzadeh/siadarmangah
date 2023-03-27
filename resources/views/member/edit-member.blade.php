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

                <h1 class="h3 mb-4 text-gray-800">Modifica - {{$member->name}} {{$member->surname}}</h1>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <a href="{{route('member-scheda', $member->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                class="fas fa-paperclip fa-lg text-white-50"></i>Apri scheda socio</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('member-bolletino', $member->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                class="fas fa-paperclip fa-lg text-white-50"></i>GENERA BOLLETTINO</a>
                    </div>
                </div>

                <form action="{{route('edit-member', $member->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    @include('member.fields')
                </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
@include('common.footer')
