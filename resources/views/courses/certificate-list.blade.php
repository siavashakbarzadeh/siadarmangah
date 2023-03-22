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
                <h1 class="h3 mb-2 text-gray-800">Attestati</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{route('course-detail-page', $course->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-arrow-circle-left fa-lg text-white-50"></i> Torna alla scheda corso</a>
                            </div>
                            <div class="col-md-4">
                                <a onclick="massiveSend({{$course->id}})" class="d-none d-sm-inline-block btn btn-md btn-danger shadow-sm"><i
                                        class="fas fa-envelope fa-lg text-white-50"></i> Invia attestati</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="table-container" class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Socio</th>
                                    <th>Stato</th>
                                    <th>Invia</th>
                                    <th>Visualizza</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($certificates as $certificate)
                                    <tr>
                                        <td> <input value="{{\Illuminate\Support\Carbon::parse($certificate->course->start )->format('d-m-Y')}}" class="form-control" type="text" readonly /> </td>
                                        <td>{{$certificate->member->name}} {{$certificate->member->surname}}</td>
                                        <td>
                                            <input readonly value="{{($certificate->sent == 0) ? 'Non inviato' : 'Inviato'}}"
                                                   class="form-control {{($certificate->sent == 0) ? 'table-danger' : 'table-success'}}"
                                            />
                                        </td>
                                        <td onclick="send({{$certificate->course->id}},{{$certificate->member_id}})"><i class="fas fa-envelope" ></i></td>
                                        <td> <a href="{{\Illuminate\Support\Facades\Storage::url($certificate->path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a> </td>
                                        <td>
                                            <form action="{{route('delete-certificate')}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="certificate_id" value="{{$certificate->id}}">
                                                <button type="submit" class="no-button"> <i class="fas fa-trash-alt red"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{$certificates->links()}}
            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>

    $(".printer").on("click", function(){
        let url = $(this).data('path');
        PrintPdf(url);
    });

    function PrintPdf (pdf) {
        var iframe = document.createElement('iframe');
        iframe.style.display = "none";
        iframe.src = pdf;
        document.body.appendChild(iframe);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }

    function massiveSend(course_id){

        Swal.fire({
            title: 'Confermi di voler inviare gli attestati via email?',
            showDenyButton: true,
            confirmButtonText: 'Conferma',
            denyButtonText: `Annulla`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: "/massive-send-certificates",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        course_id:course_id
                    },
                    success:function(response){
                        location.reload();
                    },
                    error: function(response) {

                    },
                });

            } else if (result.isDenied) {
                Swal.fire('Invio annullato', '', 'info')
            }
        })
    };

    function send(course_id, member_id){

        Swal.fire({
            title: 'Confermi di voler inviare l\'attestato via email?',
            showDenyButton: true,
            confirmButtonText: 'Conferma',
            denyButtonText: `Annulla`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: "/certificate/send/",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        course_id:course_id,
                        member_id:member_id
                    },
                    success:function(response){
                        location.reload();
                    },
                    error: function(response) {

                    },
                });

            } else if (result.isDenied) {
                Swal.fire('Invio annullato', '', 'info')
            }
        })
    };
</script>

@include('common.footer')
