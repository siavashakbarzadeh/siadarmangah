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
                    </div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{route('add-course')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Nome Corso</label>
                                        <input class="form-control" type="text" name="course" value="{{old('course')}}">
                                        @if(!empty($errors->first('course')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('course')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Codice evento</label>
                                        <input class="form-control" type="text" name="event_code" value="{{old('event_code')}}">
                                        @if(!empty($errors->first('event_code')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('event_code')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Codice edizione</label>
                                        <input class="form-control" type="text" name="edition_code" value="1">
                                        @if(!empty($errors->first('edition_code')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('edition_code')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Ente accreditante</label>
                                        <select name="accreditor_code" class="form-control" name="education">
                                            @foreach($accreditors as $accreditor)
                                                <option value="{{$accreditor->id}}">{{$accreditor->accreditor}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Codice organizzatore</label>
                                        <input class="form-control" type="text" name="organizer_code" value="373">
                                        @if(!empty($errors->first('organizer_code')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('organizer_code')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Data di inizio</label>
                                        <input class="form-control" type="date" name="start" value="{{old('start')}}">
                                        @if(!empty($errors->first('start')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('start')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Data di conclusione</label>
                                        <input class="form-control" type="date" name="end" value="{{old('end')}}">
                                        @if(!empty($errors->first('end')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('end')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Durata in ore</label>
                                        <input class="form-control" type="text" name="course_hours" value="{{old('course_hours')}}">
                                        @if(!empty($errors->first('course_hours')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('course_hours')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Numero di crediti</label>
                                        <input class="form-control" type="text" name="course_credits" value="{{old('course_credits')}}">
                                        @if(!empty($errors->first('course_credits')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('course_credits')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Tipo di formazione</label>
                                        <select class="form-control" name="education">
                                            @foreach($eventTypes as $eventType)
                                                <option value="{{$eventType->id}}">{{$eventType->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Tipo di evento</label>
                                        <select class="form-control" name="event_type">
                                            <option value="E">Evento</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Ambito/obiettivo</label>
                                        <select class="form-control" name="goal_id">
                                            @foreach($goals as $goal)
                                                <option value="{{$goal->id}}">{{$goal->description}}</option>
                                            @endforeach
                                        </select>
                                        @if(!empty($errors->first('goald_id')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('goald_id')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Numero di partecipanti</label>
                                        <input class="form-control" type="text" name="attendees_number" value="{{old('attendees_number')}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Responsabile scientifico</label>
                                        <select class="form-control" id="search" name="scientific_head_member_id"></select>
                                        @if(!empty($errors->first('scientific_head_member_id')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('scientific_head_member_id')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Importo versamento</label>
                                        <input class="form-control" type="number" name="amount" value="{{old('amount')}}">
                                        @if(!empty($errors->first('amount')))
                                            <div class="alert alert-danger" role="alert">
                                                {{$errors->first('amount')}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Importo in lettere</label>
                                        <input class="form-control" type="text" name="letter_amount" value="{{old('letter_amount')}}">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Segreteria organizzativa</label>
                                        <input class="form-control" type="text" name="organizational_secretariat" value="{{old('organizational_secretariat')}}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Referente</label>
                                        <input class="form-control" type="text" name="reference_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="formFile" class="form-label">Numero di telefono referente</label>
                                        <input class="form-control" type="text" name="reference_telephone_number">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Aggiungi corso</button>
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
<script type="text/javascript">
    $('#search').select2({
        placeholder: 'Seleziona il responsabile scientifico',
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
                console.log(response);
                $('[name="letter_amount"]').val(response);
            },
            error: function(response) {

            },
        });
    });

</script>
@include('common.footer')
