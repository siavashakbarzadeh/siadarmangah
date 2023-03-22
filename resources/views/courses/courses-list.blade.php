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
                <h1 class="h3 mb-2 text-gray-800">Lista corsi</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        @can('add-course')
                        <a href="{{route('new-course')}}"> <h6 class="m-0 font-weight-bold text-primary text-right">Aggiungi corso<span> <i class="fas fa-university"></i> </span> </h6>   </a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Corso</th>
                                    <th>Luogo</th>
                                    <th>Data di inizio</th>
                                    <th>Data di conclusione</th>
                                    <th>Crediti</th>
                                    <th>Modifica</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Corso</th>
                                    <th>Luogo</th>
                                    <th>Data di inizio</th>
                                    <th>Data di conclusione</th>
                                    <th>Crediti</th>
                                    <th>Modifica</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{$course->course}}</td>
                                        <td>{{$course->place}}</td>
                                        <td>{{substr($course->start, 0, 10)}}</td>
                                        <td>{{substr($course->end, 0 ,10)}}</td>
                                        <td>{{$course->course_credits}}</td>
                                        <td class="text-center">
                                            @can('edit-course')
                                            <a class="member-icons" href="{{route('course-detail-page', $course->id)}}"> <i class="fas fa-edit"> </i> </a>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- /.container-fluid -->
            {{$courses->links()}}
        </div>
        <!-- End of Main Content -->


        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@include('common.footer')
