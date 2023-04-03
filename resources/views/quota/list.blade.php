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
                <h1 class="h3 mb-2 text-gray-800">Invio quote</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('send-quota')}}">
                            @csrf
                            <div class="row  mb-4">
                                <div class="col-md-6">
                                    <label>Regione</label>
                                    <select name="region" class="form-control">
                                        @foreach($regions as $region)
                                            @if(app('request')->input('region') == $region->id)
                                                <option value="{{$region->id}}" selected>{{$region->region}}</option>
                                            @else
                                                <option value="{{$region->id}}">{{$region->region}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Da inviare</label><br>
                                    <p>{{$members}}</p>
                                </div>
                                <div class="col-md-2">
                                    <label>Genera allegati</label><br>
                                    <button class="btn btn-primary">Genera</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form method="GET">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label>Regione</label>
                                            <select name="region" class="form-control">
                                                @foreach($regions as $region)
                                                    @if($region->id == $filters['region'])
                                                        <option value="{{$region->id}}" selected>{{$region->region}}</option>
                                                    @else
                                                        <option value="{{$region->id}}">{{$region->region}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </th>
                                        <th><button class="btn btn-primary">Filtra</button></th>
                                        <th><button class="btn btn-danger">Invia quote</button></th>
                                    </tr>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cognome</th>
                                        <th>Scheda</th>
                                        <th>Corsi</th>
                                        <th>Privacy</th>
                                        <th>Conto Corrente</th>
                                        <th>Invio</th>
                                    </tr>
                                    </thead>
                                </form>
                                <tbody>
                                @foreach($quotasSent as $quota)
                                    <tr>
                                        <td>{{$quota->name}}</td>
                                        <td>{{$quota->surname}}</td>
                                        <td> <a href="{{\Illuminate\Support\Facades\Storage::url($quota->scheda_path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a> </td>
                                        <td>
                                            @if(!is_null($quota->courses_path))
                                            <a href="{{\Illuminate\Support\Facades\Storage::url($quota->courses_path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $quota->privacy_path }}
                                            @if($quota->privacy_path)
                                            <a href="{{\Illuminate\Support\Facades\Storage::url($quota->privacy_path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a>
                                            @endif
                                        </td>

                                        <td>
                                            sfasfas
                                            @if(!is_null($quota->payment_path))
                                                <a href="{{\Illuminate\Support\Facades\Storage::url($quota->payment_path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a>
                                            @endif
                                        </td>
                                        <td> <i onclick="send({{$quota->member_id}})" class="fas fa-envelope pointer blue-link"></i> </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{$quotasSent->appends(['region'=>$filters['region']])->links()}}
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<script>

    function send(member_id){

        Swal.fire({
            title: 'Confermi di voler inviare gli allegati via email?',
            showDenyButton: true,
            confirmButtonText: 'Conferma',
            denyButtonText: `Annulla`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: "/quota/send/attachments",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
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
