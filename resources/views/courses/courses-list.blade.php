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
{{--                        @can('add-course')--}}
                        <a href="{{route('new-course')}}"> <h6 class="m-0 font-weight-bold text-primary text-right">Aggiungi corso<span> <i class="fas fa-university"></i> </span> </h6>   </a>
{{--                        @endcan--}}
                    </div>

                    <div class="card-body">
                        <form method="get">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-4">
                                    <label>Cerca</label>
                                    <input autocomplete="off" id="search" name="q" class="form-control" type="text">
                                    <div style="display: none;" id="display-results" class="alert alert-primary" role="alert">

                                    </div>
                                </div>
                                <div class="col-md-d-2">
                                    <label>Cerca</label>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Cerca</button>
                                </div>
                            </div>
                        </form>
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
{{--                                            @can('edit-course')--}}
                                            <a class="member-icons" href="{{route('course-detail-page', $course->id)}}"> <i class="fas fa-edit"> </i> </a>
{{--                                            @endcan--}}
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

<script>

    $("#search").keyup(function(e){
        let searchString = $("#search").val();
        $("#display-results").empty();
        $.ajax({
            url: "/course/search",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                "q":searchString
            },
            success:function(response){
                console.log(response)
                $("#display-results").css("display","block");
                response.courses.forEach(function(course){
                    let markup = "<p style='cursor:pointer' onclick=compile('"+course.id+"') style='height: 20px'>"+course.course+"</p>";
                    $("#display-results").prepend(markup)
                    if(!searchString){
                        $(".child-results").remove();
                        $("#display-results").css('display','none');
                    }
                });
            },
            error: function(response) {

            },
        });
    });
    function compile(id)
    {
        $("#search").val(id);
    }
</script>

@include('common.footer')
