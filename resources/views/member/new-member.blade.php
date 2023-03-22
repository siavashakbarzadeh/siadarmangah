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

                <h1 class="h3 mb-4 text-gray-800">Aggiungi Anagrafica</h1>


                <form type="submit" action="{{route('create-member')}}" method="post">
                    @csrf
                    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <b>Anagrafica</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-3 col-sm-1">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="qualification" class="form-label">Titolo</label>
                                            <input type="hidden" name="qualification">
                                            <select name="qualification" class="form-control" aria-label="titolo">
                                                <option> - </option>
                                                @foreach($titles as $title)
                                                    <option value="{{$title->title}}">{{$title->title}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('qualification')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('qualification')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="cognome" class="form-label">Cognome</label>
                                            <input type="text" name="surname" value="{{old('surname')}}" class="form-control" aria-label="Cognome">
                                            @if(!empty($errors->first('surname')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('surname')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" value="{{old('name')}}" name="name" class="form-control" aria-label="Nome">
                                            @if(!empty($errors->first('name')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" value="{{old('email')}}" name="email"  class="form-control" aria-label="Email">
                                            @if(!empty($errors->first('email')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('email')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="gender" class="form-label">Sesso</label>
                                            <br>
                                            <select name="gender" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                    <option selected disabled hidden> - </option>
                                                    <option value="m">M</option>
                                                    <option value="f">F</option>
                                            </select>
                                            @if(!empty($errors->first('gender')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('gender')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="birthplace" class="form-label">Luogo di nascita</label>
                                            <select name="birth_place" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona una città</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->id}}">{{$county->city}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('birth_place')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('birth_place')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="birth_date" class="form-label">Data di nascita</label>
                                            <input type="date" value="{{old('birth_date')}}" name="birth_date" class="form-control" aria-label="birth_date">
                                            @if(!empty($errors->first('birth_date')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('birth_date')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-1">
                                            <label for="nome" class="form-label">Codice Fiscale</label>
                                            <input type="text" name="fiscal_code" class="form-control" aria-label="fiscal_code">
                                            @if(!empty($errors->first('fiscal_code')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('fiscal_code')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                            <label for="nome" class="form-label">Codice Fiscale</label>
                                            <button id="calculate-cf" class="btn btn-primary">Calcola</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="status" class="form-label">Stato</label>
                                            <select name="status" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden> - </option>
                                                    <option value="1" >Attivo</option>
                                                    <option value="0">Sospeso</option>
                                            </select>
                                            @if(!empty($errors->first('status')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('status')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="consent" class="form-label">Consenso privacy</label>
                                            <br>
                                            <select name="consent" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden> - </option>
                                                    <option value="1" >Si</option>
                                                    <option value="0">No</option>
                                            </select>
                                            @if(!empty($errors->first('consent')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('consent')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="notes" class="form-label">Note</label>
                                            <textarea class="form-control" name="notes" rows="1">

                            </textarea>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="yo_sid" class="form-label">YoSid</label>
                                            <select name="yo_sid" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                    <option value="" selected disabled hidden> - </option>
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                            </select>
                                            @if(!empty($errors->first('yo_sid')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('yo_sid')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="subscription_date" class="form-label">Data di iscrizione</label>
                                            <input type="date" value="{{old('subscription_date')}}" name="subscription_date" class="form-control" aria-label="subscription_date">
                                            @if(!empty($errors->first('subscription_date')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('subscription_date')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="member_type" class="form-label">Tipologia Socio</label>
                                            <select name="member_type" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona tipologia</option>
                                                @foreach($memberTypes as $memberType)
                                                    <option value="{{$memberType->description}}"> {{$memberType->description}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('member_type')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('member_type')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="council_charge" class="form-label">Posizione nel CD SID</label>
                                            <select name="council_charge" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option disabled selected value> -- </option>
                                                @foreach($councilCharges as $councilCharge)
                                                    <option value="{{$councilCharge->id}}"> {{$councilCharge->charge}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('council_charge')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('council_charge')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="region" class="form-label">Regione</label>
                                            <select name="region" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona regione</option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->id}}"> {{$region->region}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('region')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('region')}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="job_type" class="form-label">Tipo di attività</label>
                                            <select name="job_type" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                @foreach($jobTypes as $jobType)
                                                    <option value="{{$jobType->id}}"> {{$jobType->description}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('job_type')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('job_type')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="member_category" class="form-label">Categoria</label>
                                            <select name="member_category" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"> {{$category->type}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('member_category')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('member_category')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="sub_category" class="form-label">Sotto Categoria</label>
                                            <select name="sub_category" disabled class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option disabled selected value> -- </option>
                                                @foreach($juniorCategory as $category)
                                                    <option value="{{$category->id}}"> {{$category->category}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('sub_category')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('sub_category')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="expire" class="form-label">Scadenza</label>
                                            <input type="date" value="{{old('expire')}}" name="expire" class="form-control" aria-label="expire_no_time">
                                            @if(!empty($errors->first('expire')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('expire')}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="quota" class="form-label">Importo quota</label>
                                            <select class="form-select form-select-md col" id="quota-select" name="quota">
                                                @foreach($categories->sortBy('quota') as $category)
                                                    <option value="{{$category->quota}}">{{$category->quota}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('quota')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('quota')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="professions" class="form-label">Professione</label>
                                            <select name="profession_id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                @foreach($professions as $profession)
                                                    <option value="{{$profession->id}}"> {{$profession->profession}} </option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('professions')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('professions')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    <b>Residenza e recapito</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="address" class="form-label">Indirizzo</label>
                                            <input type="text" name="address" class="form-control" aria-label="address">
                                            @if(!empty($errors->first('address')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('address')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="city" class="form-label">Città</label>
                                            <select name="city" id="select-city"  class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona una città</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->id}}">{{$county->city}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('city')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('city')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="cap" class="form-label">CAP</label>
                                            <select name="cap" id="select-cap" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona il CAP</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->CAP}}">{{$county->CAP}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('cap')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('cap')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="cap" class="form-label">Provincia</label>
                                            <select name="province" id="select-province" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona la provincia</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->province}}">{{$county->province}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('province')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('province')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="telephone1" class="form-label">Telefono</label>
                                            <input type="text" name="telephone1" class="form-control" aria-label="telephone1">
                                            @if(!empty($errors->first('telephone1')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('telephone1')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="telephone2" class="form-label">Cellulare</label>
                                            <input type="text" name="telephone2"  class="form-control" aria-label="telephone2">
                                            @if(!empty($errors->first('telephone2')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('telephone1')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    <b>Sede e indirizzo di lavoro</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="office" class="form-label">Unità organizzativa</label>
                                            <input type="text" name="office"  class="form-control" aria-label="office">
                                            @if(!empty($errors->first('office')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('office')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="head_quarters" class="form-label">Indirizzo</label>
                                            <input type="text" name="head_quarters"  class="form-control" aria-label="head_quarters">
                                            @if(!empty($errors->first('head_quarters')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('head_quarters')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="office_city" class="form-label">Città</label>
                                            <select name="office_city" id="select-city-office"  class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona una città</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->id}}">{{$county->city}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('office_city')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('office_city')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="cap_office_city" class="form-label">CAP</label>
                                            <select name="cap_office_city" id="select-office-cap"  class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona il CAP</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->CAP}}">{{$county->CAP}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('cap_office_city')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('cap_office_city')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="province_office_city" class="form-label">Provincia</label>
                                            <select name="province_office_city" id="select-office-province"  class="form-select form-select-md col" aria-label=".form-select-lg example">
                                                <option value="" selected disabled hidden>Seleziona la provincia</option>
                                                @foreach($counties as $county)
                                                    <option value="{{$county->province}}">{{$county->province}}</option>
                                                @endforeach
                                            </select>
                                            @if(!empty($errors->first('province_office_city')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('province_office_city')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="telephone_3" class="form-label">Telefono</label>
                                            <input type="text" name="telephone_3" value="{{old('telephone_3', $member->job->telephone_3 ?? null)}}" class="form-control" aria-label="telephone_3">
                                            @if(!empty($errors->first('telephone_3')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('telephone_3')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-1">
                                            <label for="telephone_4" class="form-label">Cellulare</label>
                                            <input type="text" name="telephone_4"  class="form-control" aria-label="telephone_4">
                                            @if(!empty($errors->first('telephone_4')))
                                                <div class="alert alert-danger" role="alert">
                                                    {{$errors->first('telephone_4')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </div>
                </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>SID soci</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<script>
    $('#save').on('click',function(e){
        let payment_reason = $('#payment_reason').val();
        let amount = $('#amount').val();
        let date = $('#date').val();
        let member_id = $('#member_id').val();
        $('#payment_reason_alert').removeClass('display');
        $('#payment_reason_alert').addClass('hidden');
        $('#amount_alert').removeClass('display');
        $('#amount_alert').addClass('hidden');
        $('#date_alert').removeClass('display');
        $('#date_alert').addClass('hidden');

        $.ajax({
            url: "/quota/add",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                payment_reason:payment_reason,
                date:date,
                amount:amount,
                member_id:member_id
            },
            success:function(response){
                if(response.payment_reason != undefined)
                {
                    $('#payment_reason_alert').addClass('display');
                    $('#payment_reason_alert').html('<p>'+response.payment_reason+'</p>');
                }
                if(response.amount != undefined)
                {
                    $('#amount_alert').addClass('display');
                    $('#amount_alert').html('<p>'+response.amount+'</p>');
                }
                if(response.date != undefined)
                {
                    $('#date_alert').addClass('display');
                    $('#date_alert').html('<p>'+response.date+'</p>');
                }
                if(response == 1)
                {
                    location.reload();
                }
            },
            error: function(response) {

            },
        });
    });

    $('.course-autocompile').on('change',function(e){
        let course_id = $(this).val();
        $("#rm").remove();

        $.ajax({
            url: "/course/detail/"+course_id,
            type:"GET",
            success:function(response){
                let formattedStart = response.start.substring(0,10);
                let formattedEnd = response.end.substring(0,10);
                $("#place").val(response.place);
                $("#start").val(formattedStart);
                $("#end").val(formattedEnd);
                $("#member_type").val(response.member_type);
                $("#course_credits").val(response.course_credits);
                $("#value").append($("<option id='rm' selected></option>").attr("value", response.course_credits).text(response.course_credits));
                $("#credits_earned_date").val(formattedEnd);
            },
            error: function(response) {

            },
        });
    });

    $('#add-frequency').on('click',function(e){
        e.preventDefault();
        let course_id = $('[name="course_id"]').val();
        let credit_type = $('#credit_type').val();
        let member_id = $('#member_id').val();
        let member_type = $('#member_type').val();
        let value = $('#value').val();
        let place = $('#place').val();
        let sponsor = $('#sponsor').val();
        let credits_earned_date = $('#credits_earned_date').val();

        $('#place_error').removeClass('display');
        $('#start_error').removeClass('display');
        $('#end_error').removeClass('display');
        $('#member_type_error').removeClass('display');
        $('#course_credits_error').removeClass('display');
        $('#value_error').removeClass('display');
        $('#credits_earned_date_error').removeClass('display');

        $.ajax({
            url: "/frequency/add/",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                course_id:course_id,
                credit_type:credit_type,
                id:member_id,
                member_type:member_type,
                value:value,
                place:place,
                sponsor:sponsor,
                credits_earned_date:credits_earned_date
            },
            success:function(response){
                console.log(response);
                if(response.place != undefined)
                {
                    $('#place_error').addClass('display');
                    $('#place_error').html('<p>'+response.place+'</p>');
                }
                if(response.start != undefined)
                {
                    $('#start_error').addClass('display');
                    $('#start_error').html('<p>'+response.start+'</p>');
                }
                if(response.end != undefined)
                {
                    $('#end_error').addClass('display');
                    $('#end_error').html('<p>'+response.end+'</p>');
                }
                if(response.member_type != undefined)
                {
                    $('#member_type_error').addClass('display');
                    $('#member_type_error').html('<p>'+response.member_type+'</p>');
                }
                if(response.course_credits != undefined)
                {
                    $('#course_credits_error').addClass('display');
                    $('#course_credits_error').html('<p>'+response.course_credits+'</p>');
                }
                if(response.value != undefined)
                {
                    $('#value_error').addClass('display');
                    $('#value_error').html('<p>'+response.value+'</p>');
                }
                if(response.credits_earned_date != undefined)
                {
                    $('#credits_earned_date_error').addClass('display');
                    $('#credits_earned_date_error').html('<p>'+response.credits_earned_date+'</p>');
                }
                if(response.id != undefined)
                {
                    $('#id_error').addClass('display');
                    $('#id_error').html('<p>'+response.id+'</p>');
                }
                if(response == 1){
                    location.reload();
                }
            },
            error: function(response) {

            },
        });
    });

    $('#add-discipline').on('click',function(e){
        e.preventDefault();
        let selectDiscipline = $('#select-discipline').val();
        let member_id = $('#member_id').val();
        $('#discipline_error').removeClass('display');

        $.ajax({
            url: "/discipline/add/",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                member_id:member_id,
                discipline_id:selectDiscipline
            },
            success:function(response){
                if(response.discipline_id != undefined)
                {
                    $('#discipline_error').addClass('display');
                    $('#discipline_error').html('<p>'+response.discipline_id+'</p>');
                }
                if(response == 1){
                    location.reload();
                }
            },
            error: function(response) {

            },
        });
    });

    $('#save-study-group').on('click',function(e){
        e.preventDefault();
        let member_id = $('#member_id').val();
        let study_group_id = $('#study-group-id').val();
        let charge_type_id = $('#charge-type-id').val();

        $('#study-group-error').removeClass('display');

        $.ajax({
            url: "/study-group/add/",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                member_id:member_id,
                study_group_id:study_group_id,
                charge_type_id:charge_type_id
            },
            success:function(response){
                if(response.discipline_id != undefined)
                {
                    $('#discipline_error').addClass('display');
                    $('#discipline_error').html('<p>'+response.discipline_id+'</p>');
                }
                if(response == 1){
                    location.reload();
                }
            },
            error: function(response) {

            },
        });
    });

    $('#delete-study-group').on('click',function(e){
        e.preventDefault();
        let member_id = $('#member_id').val();
        let study_group_id = $('#study-group-id').val();
        let charge_type_id = $('#charge-type-id').val();

        $.ajax({
            url: "/study-group/delete/",
            type:"DELETE",
            data:{
                "_token": "{{ csrf_token() }}",
                member_id:member_id,
                study_group_id:study_group_id,
                charge_type_id:charge_type_id
            },
            success:function(response){
                console.log(response);
                if(response == 1){
                    location.reload();
                }
            },
            error: function(response) {

            },
        });
    });
</script>

<script type="text/javascript">

    let data = {
        id: 0
    };

    let newOption = new Option(data.text, data.id, false, false);
    $('#search').append(newOption).trigger('change');

    $('#search').select2({
        placeholder: 'Seleziona un corso',
        ajax: {
            url: '/course/compile',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.course,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#calculate-cf').on('click',function(e){
        e.preventDefault();
        let name = $('[name="name"]').val();
        let surname = $('[name="surname"]').val();
        let birth_date = $('[name="birth_date"]').val();
        let gender = $('[name="gender"]').val();
        let birth_place = $('[name="birth_place"]').val();

        $.ajax({
            url: "/member/cf",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                name:name,
                surname:surname,
                birth_date:birth_date,
                gender:gender,
                birth_place:birth_place
            },
            success:function(response){
                $('[name="fiscal_code"]').val(response);
            },
            error: function(response) {

            },
        });
    });


    $('[name="member_type"]').on('change', function(){
        let selected = $('[name="member_type"] option:selected').val();
        if(selected === 'Onorario'){
            $('[name="member_category"]').prop('disabled', 'disabled');
            $('[name="quota"]').prop('disabled', 'disabled');
            $('[name="council_charge"]').prop('disabled', 'disabled');
        } else {
            $('[name="member_category"]').prop('disabled', false);
            $('[name="quota"]').prop('disabled', false);
            $('[name="council_charge"]').prop('disabled', false);
        }
    });

    $('[name="member_category"]').on('change', function(){
        let selected = $('[name="member_category"] option:selected').val();
        if(selected == 9){
            $('[name="sub_category"]').prop('disabled', false);
        } else {
            $('[name="sub_category"]').prop('disabled', 'disabled');
            $('[name="sub_category"]').val('');
        }

        if(selected == 2){
            $('#quota-select option[value=75]').attr('selected','selected');
        }
        if(selected == 3){
            $('#quota-select option[value=100]').attr('selected','selected');
        }
        if(selected == 4){
            $('#quota-select option[value=150]').attr('selected','selected');
        }
        if(selected == 5){
            $('#quota-select option[value=125]').attr('selected','selected');
        }
        if(selected == 6){
            $('#quota-select option[value=35]').attr('selected','selected');
        }
        if(selected == 7){
            $('#quota-select option[value=35]').attr('selected','selected');
        }
        if(selected == 8){
            $('#quota-select option[value=60]').attr('selected','selected');
        }
        if(selected == 9){
            $('#quota-select option[value=10]').attr('selected','selected');
        }
        if(selected == 10){
            $('#quota-select option[value=35]').attr('selected','selected');
        }
        if(selected == 11){
            $('#quota-select option[value=0]').attr('selected','selected');
        }
    });



    $('[name="city"]').on('change', function(){
        let selected = $('[name="city"] option:selected').val();

        $.ajax({
            url: "/member/city-detail",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:selected
            },
            success:function(response){
                $('#select-cap option[value='+response.CAP+']').attr('selected','selected');
                $('#select-province option[value='+response.province+']').attr('selected','selected');
            },
            error: function(response) {

            },
        });
    });

    $('[name="office_city"]').on('change', function(){
        let selected = $('[name="office_city"] option:selected').val();

        $.ajax({
            url: "/member/city-detail",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:selected
            },
            success:function(response){
                $('#select-office-cap option[value='+response.CAP+']').attr('selected','selected');
                $('#select-office-province option[value='+response.province+']').attr('selected','selected');
            },
            error: function(response) {

            },
        });
    });

</script>
<!-- End of Page Wrapper -->
@include('common.footer')
