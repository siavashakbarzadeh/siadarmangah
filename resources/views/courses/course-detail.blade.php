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
                <h1 class="h3 mb-2 text-gray-800">Dettaglio corso</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('course-export', $course->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-download fa-lg text-white-50"></i>Genera Modello MIN crediti</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('course-export-no-credits', $course->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-download fa-lg text-white-50"></i> Genera Modello MIN senza crediti</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('course-export-total', $course->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-download fa-lg text-white-50"></i>Genera Modello MIN Totale</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('course-certificate', $course->id)}}" class="{{(empty($sign)) ? 'disabled-anchor' : ''}} d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-user-graduate fa-lg text-white-50"></i> Genera Attestati</a>
                            </div>
                        </div>
                            <div class="row mt-4">
                            <div class="col-md-3">
                                <a href="{{route('course-certificates-list', $course->id)}}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                                        class="fas fa-user-graduate fa-lg text-white-50"></i> Gestisci Attestati</a>
                            </div>
                            </div>
                    </div>

                    <div class="card-body">
                    <div class="col-md-12">
                        <form action="{{route('edit-course', $course->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Codice evento</label>
                                    <input class="form-control" type="text" value="{{$course->event_code}}" name="event_code">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Codice edizione</label>
                                    <input class="form-control" type="text" value="{{$course->edition_code}}" name="edition_code">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Codice organizzatore</label>
                                    <input class="form-control" type="text" value="{{$course->organizer_code}}" name="organizer_code">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Ente accreditante</label>
                                    <select name="accreditor_code" class="form-control" name="education">
                                        @foreach($accreditors as $accreditor)
                                            @if($accreditor->id == $course->accreditor_code)
                                            <option value="{{$accreditor->id}}" selected>{{$accreditor->accreditor}}</option>
                                            @else
                                            <option value="{{$accreditor->id}}">{{$accreditor->accreditor}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Corso</label>
                                    <input class="form-control" type="text" value="{{$course->course}}" name="course">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Data di inizio</label>
                                    <input class="form-control" type="text" value="{{Carbon\Carbon::parse($course->start)->format('d-m-Y')}}" name="start">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Data di conclusione</label>
                                    <input class="form-control" type="text" value="{{Carbon\Carbon::parse($course->end)->format('d-m-Y')}}" name="end">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Durata in ore</label>
                                    <input class="form-control" type="text" value="{{$course->course_hours}}" name="course_hours">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Numero di crediti</label>
                                    <input class="form-control" type="text" value="{{$course->course_credits}}" name="course_credits">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Tipo di formazione</label>
                                    <select class="form-control" name="education">
                                        @foreach($eventTypes as $eventType)
                                            @if($eventType->id == $course->event_type)
                                            <option value="{{$eventType->id}}" selected>{{$eventType->type}}</option>
                                            @else
                                            <option value="{{$eventType->id}}">{{$eventType->type}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Tipo di evento</label>
                                    <select class="form-control">
                                        <option>Evento</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Ambito/obiettivo</label>
                                    <select class="form-control" name="goal_id">
                                        @foreach($goals as $goal)
                                            <option value="{{$goal->id}}" {{$course->goal->contains($goal->id) ? 'selected' : ''}}>{{$goal->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Numero di partecipanti</label>
                                    <input class="form-control" type="text" value="{{count($course->frequencies)}}" name="attendees_number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Luogo</label>
                                    <input class="form-control" type="text" value="{{$course->place}}" name="place">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Responsabile scientifico</label>
                                    <select class="form-control" id="search" name="scientific_head_member_id">
                                        @if($course->scientific_head != 0 || $course->scientific_head != NULL)
                                            <option value="{{$course->scientificHead->id}}">{{$course->scientificHead->qualification}} {{$course->scientificHead->name}} {{$course->scientificHead->surname}}</option>
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('scientific_head_member_id')))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('scientific_head_member_id')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Importo versamento</label>
                                    <input class="form-control" type="text" value="{{$course->amount}}" name="amount">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Importo in lettere</label>
                                    <input class="form-control" type="text" value="{{$course->letter_amount}}" name="letter_amount">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Firma del responsabile scientifico</label>
                                    <input class="form-control" type="file"  name="sign">
                                    @if(empty($sign))
                                        <p class="alert-danger mt-2 p-2">ATTENZIONE! Non è stata impostata la firma del responsabile scientifico. Prima di generare gli attestati è obbligatorio impostarla</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Segreteria organizzativa</label>
                                    <input class="form-control" type="text" value="{{$course->organizational_secretariat}}" name="organizational_secretariat">
                                </div>

                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Referente</label>
                                    <input class="form-control" type="text" value="{{$course->reference_name}}" name="reference_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="formFile" class="form-label">Numero di telefono referente</label>
                                    <input class="form-control" type="text" value="{{$course->reference_telephone_number}}" name="reference_telephone_number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Modifica corso</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Ripartizione partecipanti
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Tipo di socio</th>
                                    <th>Totale</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Ordinario</td>
                                        <td>{{$ordinaryMembers}}</td>
                                    </tr>
                                    <tr>
                                        <td>Partecipante ECM</td>
                                        <td>{{$ecmMembers}}</td>
                                    </tr>
                                    <tr>
                                        <td>Docenti</td>
                                        <td>{{$teacher}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Aggiungi Sponsor
                    </div>

                    <div class="card-body">
                        <form action="{{route('add-course-sponsor')}}" method="POST">
                            @csrf
                            <label><b>Seleziona un'azienda sponsor dalla lista</b></label>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <select class="form-control" name="company_id">
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->companyName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" name="amount">
                                    <input type="hidden" value="{{$course->id}}" name="course_id">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit" action="{{route('add-course-sponsor')}}">Aggiungi sponsor</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Sponsor
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Azienda</th>
                                    <th>Importo</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($course->sponsors as $sponsor)
                                    <tr>
                                        <td>{{$sponsor->companyName}}</td>
                                        <td>{{$sponsor->pivot->amount}}</td>
                                        <td>
                                            <form action="{{route('delete-course-sponsor')}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" value="{{$sponsor->pivot->id}}" name="sponsor_id">
                                                <button class="no-button"><i class="fas fa-trash red"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Partecipanti al corso
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Cognome</th>
                                    <th>Nome</th>
                                    <th>Codice Fiscale</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($course->frequencies as $frequency)
                                    <tr>
                                        <td>{{$frequency->member->surname ?? ''}}</td>
                                        <td>{{$frequency->member->name ?? ''}}</td>
                                        <td>{{$frequency->member->fiscal_code ?? ''}}</td>
                                    </tr>
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
<script type="text/javascript">

    let data = {
        id: {{$course->scientific_head}}
    };

    let newOption = new Option(data.text, data.id, false, false);
    $('#search').append(newOption).trigger('change');

    $('#search').select2({
        placeholder: 'Seleziona un responsabile scientifico',
        ajax: {
            url: '/member/compile',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.surname+" "+item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });


    $('[name="amount"]').focusout(function(){
        let amount = $('[name="amount"]').val();
        $.ajax({
            url: "/course/converter",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                amount:amount,
            },
            success:function(response){
                $('[name="letter_amount"]').val(response);
            },
            error: function(response) {

            },
        });
    });
</script>
@include('common.footer')
