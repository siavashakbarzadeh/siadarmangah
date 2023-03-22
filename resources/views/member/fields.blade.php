<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <b>Anagrafica Socio</b>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show tab-background" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="qualification" class="form-label badge badge-primary text-xl badge badge-primary text-xl badge badge-primary text-xl">Codice membro</label>
                        <input type="text" value="{{$member->id ?? ''}}" readonly class="form-control" aria-label="id">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="qualification" class="form-label badge badge-primary text-xl">Titolo</label>
                        <input type="hidden" name="member_id" value="{{$member->id ?? ''}}">
                        <input type="text" name="qualification" value="{{old('qualification', $member->qualification ?? null)}}" class="form-control" aria-label="Nome">
                        @if(!empty($errors->first('qualification')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('qualification')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="cognome" class="form-label badge badge-primary text-xl">Cognome</label>
                        <input type="text" name="surname" value="{{old('surname', $member->surname??null)}}" class="form-control" aria-label="Cognome">
                        @if(!empty($errors->first('surname')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('surname')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="nome" class="form-label badge badge-primary text-xl">Nome</label>
                        <input type="text" name="name" value="{{old('name', $member->name ?? null)}}" class="form-control" aria-label="Nome">
                        @if(!empty($errors->first('name')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="email" class="form-label badge badge-primary text-xl">Email</label>
                        <input type="email" name="email" value="{{old('email', $member->email??null)}}" class="form-control" aria-label="Email">
                        @if(!empty($errors->first('email')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="gender" class="form-label badge badge-primary text-xl">Sesso</label>
                        <br>
                        <select name="gender" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @if(isset($member))
                                @if($member->gender === 'M')
                                    <option value="m" selected>M</option>
                                    <option value="f">F</option>
                                @else
                                    <option value="m">M</option>
                                    <option value="f" selected>F</option>
                                @endif
                            @else
                                <option value="m" selected>M</option>
                                <option value="f">F</option>
                            @endif
                        </select>
                        @if(!empty($errors->first('gender')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('gender')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="birthplace" class="form-label badge badge-primary text-xl">Luogo di nascita</label>
                        <select name="birth_place" class="form-select form-select-md col">
                            <option selected="selected"></option>
                            @foreach($counties as $county)
                                @if($county->id === $member->birth_place)
                                    <option value="{{$county->id}}" selected>{{$county->city}}</option>
                                @else
                                    <option value="{{$county->id}}">{{$county->city}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('birth_place')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('birth_place')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="birth_date" class="form-label badge badge-primary text-xl">Data di nascita</label>
                        <input type="date" name="birth_date" value="{{old('birth_date', Carbon\Carbon::parse($member->birth_date)->format('Y-m-d')??null)}}" class="form-control" aria-label="birth_date">
                        @if(!empty($errors->first('birth_date')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('birth_date')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="nome" class="form-label badge badge-primary text-xl">Codice Fiscale</label>
                        <input type="text" name="fiscal_code" value="{{old('fiscal_code', $member->fiscal_code??null)}}" class="form-control" aria-label="fiscal_code">
                        @if(!empty($errors->first('fiscal_code')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('fiscal_code')}}
                            </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="status" class="form-label badge badge-primary text-xl">Stato</label>
                        <select name="status" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @if(isset($member))
                                @if($member->status == 0)
                                    <option value="0" selected>Attivo</option>
                                    <option value="1">Sospeso</option>
                                @else
                                    <option value="0">Attivo</option>
                                    <option value="1" selected>Sospeso</option>
                                @endif
                            @else
                                <option value="0" selected>Attivo</option>
                                <option value="1">Sospeso</option>
                            @endif
                        </select>
                        @if(!empty($errors->first('status')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('status')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="consent" class="form-label badge badge-primary text-xl">Consenso privacy</label>
                        <br>
                        <select name="consent" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @if(isset($member))
                                @if($member->consent == 1)
                                    <option value="1" selected>Si</option>
                                    <option value="0">No</option>
                                @else
                                    <option value="1">Si</option>
                                    <option value="0" selected>No</option>
                                @endif
                            @else
                                <option value="1" selected>Si</option>
                                <option value="0">No</option>
                            @endif
                        </select>
                        @if(!empty($errors->first('consent')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('consent')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="notes" class="form-label badge badge-primary text-xl">Note</label>
                        <textarea class="form-control" name="notes" rows="1">
                                {{old('notes', $member->notes??null)}}
                            </textarea>
                        @if(!empty($errors->first('notes')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('notes')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="yo_sid" class="form-label badge badge-primary text-xl">YoSid</label>
                        <select name="yo_sid" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @if(isset($member))
                                @if($member->yo_sid == 1)
                                    <option value="1" selected>Si</option>
                                    <option value="0">No</option>
                                @else
                                    <option value="1">Si</option>
                                    <option value="0" selected>No</option>
                                @endif
                            @else
                                <option value="1" selected>Si</option>
                                <option value="0">No</option>
                            @endif
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
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="subscription_date" class="form-label badge badge-primary text-xl">Data di iscrizione</label>
                        <input type="date" name="subscription_date" value="{{old('subscription_date', \Carbon\Carbon::parse($member->position->subscription_date)->format('Y-m-d') ?? null)}}" class="form-control" aria-label="subscription_date">
                        @if(!empty($errors->first('subscription_date')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('subscription_date')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="member_type" class="form-label badge badge-primary text-xl">Tipologia Socio</label>
                        <select name="member_type" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($memberTypes as $memberType)
                                @if(isset($member->position->member_type))
                                    @if($memberType->description === $member->position->member_type)
                                        <option value="{{$member->position->member_type}}" selected> {{$member->position->member_type}} </option>
                                    @else
                                        <option value="{{$memberType->description}}"> {{$memberType->description}} </option>
                                    @endif
                                @else
                                    <option value="{{$memberType->description}}"> {{$memberType->description}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('member_type')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('member_type')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="council_charge" class="form-label badge badge-primary text-xl">Posizione nel CD SID</label>
                        <select name="council_charge" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option disabled selected value> -- </option>
                            @foreach($councilCharges as $councilCharge)
                                @if(!is_null($member->position->council_charge_id))
                                    @if($councilCharge->id === $member->position->council_charge_id)
                                        <option value="{{$member->position->council_charge_id}}" selected> {{$councilCharge->charge}} </option>
                                    @else
                                        <option value="{{$councilCharge->id}}"> {{$councilCharge->charge}} </option>
                                    @endif
                                @else
                                    <option value="{{$councilCharge->id}}"> {{$councilCharge->charge}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('council_charge')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('council_charge')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="region" class="form-label badge badge-primary text-xl">Regione</label>
                        <select name="region" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($regions as $region)
                                @if(isset($member->position))
                                    @if($region->id === $member->position->region_id)
                                        <option value="{{$member->position->region_id}}" selected> {{$region->region}} </option>
                                    @else
                                        <option value="{{$region->id}}"> {{$region->region}} </option>
                                    @endif
                                @else
                                    <option value="{{$region->id}}"> {{$region->region}} </option>
                                @endif
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
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="job_type" class="form-label badge badge-primary text-xl">Tipo di attività</label>
                        <select name="job_type" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($jobTypes as $jobType)
                                @if(isset($member->position->jobType))
                                    @if($jobType->id === $member->position->jobType->id)
                                        <option value="{{$member->position->jobType->id}}" selected> {{$member->position->jobType->description}} </option>
                                    @else
                                        <option value="{{$jobType->id}}"> {{$jobType->description}} </option>
                                    @endif
                                @else
                                    <option value="{{$jobType->id}}"> {{$jobType->description}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('job_type')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('job_type')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="member_category" class="form-label badge badge-primary text-xl">Categoria</label>
                        <select name="member_category" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($categories as $category)
                                @if(!is_null($member->position->member_category))
                                    @if($category->id === $member->position->member_category)
                                        <option value="{{$member->position->member_category}}" selected> {{$category->type}} </option>
                                    @else
                                        <option value="{{$category->id}}"> {{$category->type}} </option>
                                    @endif
                                @else
                                    <option value="{{$category->id}}"> {{$category->type}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('member_category')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('member_category')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="sub_category" class="form-label badge badge-primary text-xl">Sotto Categoria</label>
                        <select name="sub_category" disabled class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option disabled selected value> -- </option>
                            @foreach($juniorCategory as $category)
                                @if($category->id == $member->position->sub_category)
                                    <option selected value="{{$category->id}}"> {{$category->category}} </option>
                                @else
                                    <option value="{{$category->id}}"> {{$category->category}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('sub_category')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('sub_category')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="expire_no_time" class="form-label badge badge-primary text-xl">Scadenza</label>
                        <input type="date" name="expire" value="{{old('expire', \Carbon\Carbon::parse($member->position->expire)->format('Y-m-d') ?? null)}}" class="form-control" aria-label="expire_no_time">
                        @if(!empty($errors->first('expire')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('expire')}}
                            </div>
                        @endif
                    </div>


                </div>

                <br>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="quota" class="form-label badge badge-primary text-xl">Importo quota</label>
                        <select class="form-select form-select-md col" id="quota-select" name="quota">
                            @foreach($categories->sortBy('quota') as $category)
                                @if($member->position->quota == $category->quota)
                                    <option selected value="{{$category->quota}}">{{$category->quota}}</option>
                                @else
                                    <option value="{{$category->quota}}">{{$category->quota}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('quota')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('quota')}}
                            </div>
                        @endif
                        @if(!empty($errors->first('quota')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('quota')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="professions" class="form-label badge badge-primary text-xl">Professione</label>
                        <select name="profession" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($professions as $profession)
                                @if(isset($member->position->profession))
                                    @if($profession->id === $member->position->profession->id)
                                        <option value="{{$member->position->profession->id}}" selected> {{$member->position->profession->profession}} </option>
                                    @else
                                        <option value="{{$profession->id}}"> {{$profession->profession}} </option>
                                    @endif
                                @else
                                    <option value="{{$profession->id}}"> {{$profession->profession}} </option>
                                @endif
                            @endforeach
                        </select>
                        @if(!empty($errors->first('professions')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('professions')}}
                            </div>
                        @endif
                    </div>
                </div>

                <br>
                <label for="disciplines" class="form-label badge badge-primary text-xl">Discipline</label>
                <div class="row mt-3">
                    @foreach($member->disciplines as $memberDiscipline)
                        <div class="col-lg-5 col-md-5 col-sm-1">
                            <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                @foreach($disciplines as $discipline)
                                    @if(isset($member->disciplines))
                                        @if($discipline->id === $memberDiscipline->id)
                                            <option value="{{$memberDiscipline->discipline}}" selected> {{$memberDiscipline->discipline}} </option>
                                        @else
                                            <option value="{{$discipline->id}}"> {{$discipline->discipline}} </option>
                                        @endif
                                    @else
                                        <option value="{{$discipline->id}}"> {{$discipline->discipline}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1">
                            <input type="hidden" name="member_id_discipline" value="{{$member->id}}">
                            <input type="hidden" name="discipline_id" value="{{$memberDiscipline->id}}">
                            <button data-id="{{$memberDiscipline->id}}" class="no-button mt-1 delete-discipline"><i id="red" class="fas fa-trash"></i></button>
                        </div>
                    @endforeach
                    @if(!empty($errors->first('disciplines')))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('disciplines')}}
                        </div>
                    @endif
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="disciplines" class="form-label badge badge-primary text-xl">Scegli una nuova disciplina</label>
                        <select id="select-discipline" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            @foreach($disciplines as $discipline)
                                <option value="{{$discipline->id}}"> {{$discipline->discipline}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-1">
                        <label for="disciplines" class="form-label badge badge-primary text-xl">Aggiungi una nuova disciplina</label>
                        <button id="add-discipline" type="button" class="btn btn-primary">Aggiungi disciplina</button>
                    </div>
                    <div id="discipline_error" class="alert alert-danger hidden" role="alert"></div>
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
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="address" class="form-label badge badge-primary text-xl">Indirizzo</label>
                        <input type="text" name="address" value="{{old('address', $member->residence->residence ?? null)}}" class="form-control" aria-label="address">
                        @if(!empty($errors->first('address')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('address')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="city" class="form-label badge badge-primary text-xl">Città</label>
                        <input type="text" name="city" value="{{old('city', $member->residence->city ?? null)}}" class="form-control" aria-label="city">
                        @if(!empty($errors->first('city')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('city')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="cap" class="form-label badge badge-primary text-xl">CAP</label>
                        <input type="text" name="cap" value="{{old('city', $member->residence->cap ?? null)}}" class="form-control" aria-label="cap">
                        @if(!empty($errors->first('cap')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('cap')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="cap" class="form-label badge badge-primary text-xl">Provincia</label>
                        <input type="text" name="province" value="{{old('province', $member->residence->province ?? null)}}" class="form-control" aria-label="province">
                        @if(!empty($errors->first('province')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('province')}}
                            </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="telephone1" class="form-label badge badge-primary text-xl">Telefono</label>
                        <input type="text" name="telephone1" value="{{old('telephone1', $member->residence->telephone1 ?? null)}}" class="form-control" aria-label="telephone1">
                        @if(!empty($errors->first('telephone1')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('telephone1')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="telephone2" class="form-label badge badge-primary text-xl">Cellulare</label>
                        <input type="text" name="telephone2" value="{{old('telephone2', $member->residence->telephone2 ?? null)}}" class="form-control" aria-label="telephone2">
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
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="office" class="form-label badge badge-primary text-xl">Unità organizzativa</label>
                        <input type="text" name="office" value="{{old('office', $member->job->office ?? null)}}" class="form-control" aria-label="office">
                        @if(!empty($errors->first('office')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('office')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="head_quarters" class="form-label badge badge-primary text-xl">Indirizzo</label>
                        <input type="text" name="head_quarters" value="{{old('head_quarters', $member->job->head_quarters ?? null)}}" class="form-control" aria-label="head_quarters">
                        @if(!empty($errors->first('head_quarters')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('head_quarters')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="office_city" class="form-label badge badge-primary text-xl">Città</label>
                        <input type="text" name="office_city" value="{{old('office_city', $member->job->office_city ?? null)}}" class="form-control" aria-label="office_city">
                        @if(!empty($errors->first('office_city')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('office_city')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="cap_office_city" class="form-label badge badge-primary text-xl">CAP</label>
                        <input type="text" name="cap_office_city" value="{{old('cap_office_city', $member->job->cap_office_city ?? null)}}" class="form-control" aria-label="cap_office_city">
                        @if(!empty($errors->first('cap_office_city')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('cap_office_city')}}
                            </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="province_office_city" class="form-label badge badge-primary text-xl">Provincia</label>
                        <input type="text" name="province_office_city" value="{{old('province_office_city', $member->job->province_office_city ?? null)}}" class="form-control" aria-label="province_office_city">
                        @if(!empty($errors->first('province_office_city')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('province_office_city')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="telephone_3" class="form-label badge badge-primary text-xl">Telefono</label>
                        <input type="text" name="telephone_3" value="{{old('telephone_3', $member->job->telephone_3 ?? null)}}" class="form-control" aria-label="telephone_3">
                        @if(!empty($errors->first('telephone_3')))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('telephone_3')}}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="telephone_4" class="form-label badge badge-primary text-xl">Cellulare</label>
                        <input type="text" name="telephone_4" value="{{old('telephone_4', $member->job->telephone_4 ?? null)}}" class="form-control" aria-label="telephone_4">
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

    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                <b>Situazione contabile socio</b>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                <button style="margin-bottom: 20px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuotaModal">
                    Aggiungi quota
                </button>
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Situazione quote sottoscritte e pagamenti effettuati</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive vertical-scroll">
                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Descrizione movimento</th>
                                            <th>Quota</th>
                                            <th>Pagamenti</th>
                                            <th>Riferimento</th>
                                            <th>Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($member->payments as $payment)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($payment->date)->format('d-m-Y')}}</td>
                                            <td>{{$payment->payment_reason}}</td>
                                            <td>{{round($payment->amount, 2)}}</td>
                                            <td>{{round($payment->payed_amount,2)}}</td>
                                            <td>{{$payment->year}}</td>
                                            <td><button class="delete-quota" data-id="{{$payment->id}}" class="no-button"><i id="red" class="fas fa-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="{{(($unpaidQuotas - $paidQuota) != 0) ? 'table-danger' : 'table-success'}}">Saldo</td>
                                            <td class="{{(($unpaidQuotas - $paidQuota) != 0) ? 'table-danger' : 'table-success'}}">{{(($unpaidQuotas - $paidQuota) == 0) ? 0 : '-'. round($unpaidQuotas - $paidQuota, 0)}}</td>
                                            <td class="{{(($unpaidQuotas - $paidQuota) != 0) ? 'table-danger' : 'table-success'}}"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                    <b>Storico Pagamenti</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Archivio pagamenti</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Descrizione movimento</th>
                                                        <th>Quota</th>
                                                        <th>Pagamenti</th>
                                                        <th>Riferimento</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($member->PaymentHistory as $payment)
                                                        <tr>
                                                            <td>{{$payment->operation_date}}</td>
                                                            <td>{{$payment->reason}}</td>
                                                            <td>{{round($payment->quota_amount, 2)}}</td>
                                                            <td>{{round($payment->amount_paid,2)}}</td>
                                                            <td>{{$payment->year_of_reference}}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                <b>Gruppi di studio, commissioni e comitati</b>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                <div class="row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Gruppi di studio</label>
                            <select id="study-group-id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                <option value="" selected disabled hidden>Seleziona una gruppo di studio</option>
                                @foreach($studyGroups as $studyGroup)
                                    <option value="{{$studyGroup->id}}"> {{$studyGroup->group}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Posizione</label>
                            <select id="charge-type-id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                <option value="" selected disabled hidden> - </option>
                                @foreach($commissionCharges as $commissionCharge)
                                    <option value="{{$commissionCharge->id}}"> {{$commissionCharge->charge_type}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Azioni</label>
                            <br>
                            <button id="save-study-group" class="btn btn-primary">Aggiungi a gruppo di studio</button>
                        </div>
                </div>
                <br>
                <div class="row mb-4">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Comitati</label>
                        <select id="committee_id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option value="" selected disabled hidden>Seleziona un comitato</option>
                            @foreach($committees as $committee)
                                <option value="{{$committee->id}}"> {{$committee->committee}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Posizione</label>
                        <select id="charge-type-id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option value="" selected disabled hidden></option>
                            @foreach($commissionCharges as $commissionCharge)
                                <option value="{{$commissionCharge->id}}"> {{$commissionCharge->charge_type}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Azioni</label>
                        <br>
                        <button id="save-committee" class="btn btn-primary">Aggiungi a comitato</button>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Commissioni</label>
                        <select id="study-group-id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option value="" selected disabled hidden>Seleziona una commissione</option>
                            @foreach($commissions as $commission)
                                <option value="{{$commission->id}}"> {{$commission->commission}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Posizione</label>
                        <select id="charge-type-id" class="form-select form-select-md col" aria-label=".form-select-lg example">
                            <option value="" selected disabled hidden></option>
                            @foreach($commissionCharges as $commissionCharge)
                                <option value="{{$commissionCharge->id}}"> {{$commissionCharge->charge_type}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                        <label for="study_groups" class="form-label badge badge-primary text-xl">Azioni</label>
                        <br>
                        <button id="save-commission" class="btn btn-primary">Aggiungi a commissione</button>
                    </div>
                </div>

                    @foreach($member->studyGroups as $memberStudyGroup)
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-1 mb-3 mb-3">
                                <label for="study_groups" class="form-label badge badge-primary text-xl">Gruppo di studio</label>
                                <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                    @foreach($studyGroups as $studyGroup)
                                        @if($studyGroup->id === $memberStudyGroup->id)
                                        <option>{{$studyGroup->group}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if(!empty($errors->first('study_groups')))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('study_groups')}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-1 mb-3 mb-3">
                                <label for="study_groups" class="form-label badge badge-primary text-xl">Ruolo</label>
                                <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                    @foreach($commissionCharges as $commissionCharge)
                                        @if($commissionCharge->id === $memberStudyGroup->pivot->charge_type_id)
                                            <option>{{$commissionCharge->charge_type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if(!empty($errors->first('study_groups')))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('study_groups')}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                                <label for="study_groups" class="form-label badge badge-primary text-xl">Azioni</label>
                                <br>
                                <input type="hidden" name="member_id" value="{{$memberStudyGroup->pivot->member_id}}">
                                <input type="hidden" name="study_group_id" value="{{$memberStudyGroup->pivot->study_group_id}}">
                                <button class="no-button mt-1 delete-study-group"><i id="red" class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach

                @foreach($committeCharges as $committeCharge)
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Comitato</label>
                            <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                @foreach($committees as $committee)
                                    @if($committee->id === $committeCharge->committee_id)
                                        <option>{{$committee->committee}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if(!empty($errors->first('study_groups')))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('study_groups')}}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Ruolo</label>
                            <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                @foreach($commissionCharges as $commissionCharge)
                                    @if($commissionCharge->id === $committeCharge->commission_charge_id)
                                        <option>{{$commissionCharge->charge_type}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if(!empty($errors->first('study_groups')))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('study_groups')}}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-1 mb-3">
                            <label for="study_groups" class="form-label badge badge-primary text-xl">Azioni</label>
                            <br>
                            <input type="hidden" name="member_id" value="{{$memberStudyGroup->pivot->member_id}}">
                            <input type="hidden" name="study_group_id" value="{{$memberStudyGroup->pivot->study_group_id}}">
                            <button class="no-button mt-1 delete-study-group"><i id="red" class="fas fa-trash"></i></button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false" aria-controls="panelsStayOpen-collapseEight">
                <b>Partecipazione a corsi e crediti ECM</b>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                            <div class="row mb-4">
                            <h3>Aggiungi nuovo corso</h3>
                            <div class="col-lg-4 col-md-4 col-sm-1">
                                <label for="study_groups" class="form-label badge badge-primary text-xl">Descrizione corso</label><br>
                                <select style="width: 100%" class="form-control course-autocompile" id="search" name="course_id">

                                </select>
                                @if(!empty($errors->first('course_id')))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('course_id')}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <label for="place" class="form-label badge badge-primary text-xl">Luogo</label>
                                <input type="text" id="place" name="place" class="form-control" aria-label="place">
                            </div>
                            <div class="col-md-2">
                                <label for="start" class="form-label badge badge-primary text-xl">Inizio</label>
                                <input type="date" id="start" name="start" class="form-control" aria-label="start">
                            </div>
                            <div class="col-md-2">
                                <label for="end" class="form-label badge badge-primary text-xl">Fine</label>
                                <input type="date" id="end" name="end" class="form-control" aria-label="end">
                            </div>
                            <div class="col-md-2">
                                <label for="member_type" class="form-label badge badge-primary text-xl">Ruolo</label>
                                <select class="form-control" id="member_type" name="member_role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mt-4">
                                <label for="course_credits" class="form-label badge badge-primary text-xl">Crediti</label>
                                <input type="text" id="course_credits" name="course_credits" class="form-control" aria-label="course_credits">
                            </div>
                            <div class="col-md-2 mt-4">
                                <label for="value" class="form-label badge badge-primary text-xl">Valore</label>
                                <select id="value" name="value" class="form-control">
                                    <option value="" selected disabled hidden> - </option>
                                    <option value="0">0</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-4">
                                <label for="value" class="form-label badge badge-primary text-xl">Note</label>
                                <textarea class="form-control" name="notes_no_credits" rows="1"></textarea>
                            </div>
                            <div class="col-md-2 mt-4">
                                <label for="credits_earned_date" class="form-label badge badge-primary text-xl">Acquisizione</label>
                                <input type="date" id="credits_earned_date" name="credits_earned_date" class="form-control" aria-label="credits_earned_date">
                            </div>
                            <div class="col-md-2 mt-4">
                                 <label for="credits_earned_date" class="form-label badge badge-primary text-xl">Azione</label><br>
                                 <button id="add-frequency" class="btn btn-primary">Aggiungi corso</button>
                            </div>
                                <div id="place_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="start_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="end_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="member_type_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="course_credits_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="value_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="credits_earned_date_error" class="alert alert-danger hidden" role="alert"></div>
                                <div id="id_error" class="alert alert-danger hidden" role="alert"></div>
                        </div>
                        <hr>

                        @foreach($member->frequencies as $memberFrequency)
                            <div class="row mt-4 mb-4">
                                <div class="col-lg-4 col-md-4 col-sm-1">
                                    <label for="study_groups" class="form-label badge badge-primary text-xl">Descrizione corso</label>
                                    <select name="member_committee_{{$memberFrequency->id}}" class="form-select form-select-md col" aria-label=".form-select-lg example">
                                        @foreach($courses as $course)
                                            @if(isset($member->frequencies))
                                                @if($memberFrequency->course_id === $course->id)
                                                    <option value="{{$memberFrequency->id}}" selected> {{$memberFrequency->course->course}} </option>
                                                @else
                                                    <option value="{{$course->id}}"> {{$course->course}} </option>
                                                @endif
                                            @else
                                                <option value="{{$course->id}}"> {{$course->course}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if(!empty($errors->first('member_committee')))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('member_committee')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <label for="place" class="form-label badge badge-primary text-xl">Luogo</label>
                                    <input type="text" name="place" readonly class="form-control" aria-label="place" value="{{old('place', $memberFrequency->course->place ?? null)}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="start" class="form-label badge badge-primary text-xl">Inizio</label>
                                    <input type="text" name="start" readonly class="form-control" aria-label="start" value="{{old('start',substr($memberFrequency->course->start,0,10) ?? null)}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="end" class="form-label badge badge-primary text-xl">Fine</label>
                                    <input type="text" name="end" readonly class="form-control" aria-label="end" value="{{old('end', substr($memberFrequency->course->end,0,10) ?? null)}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="member_type" class="form-label badge badge-primary text-xl">Ruolo</label>
                                    <select class="form-select form-select-md col" aria-label=".form-select-lg example">
                                    @foreach($roles as $role)
                                        @if($memberFrequency->member_type == $role->id)
                                            <option selected value="{{$role->id}}">{{$role->role}}</option>
                                        @else
                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <label for="course_credits" class="form-label badge badge-primary text-xl">Crediti</label>
                                    <input type="text" name="course_credits" readonly class="form-control" aria-label="course_credits" value="{{old('credits', $memberFrequency->course->course_credits ?? null)}}">
                                </div>
                                <div class="col-md-2 mt-4">
                                    <label for="value" class="form-label badge badge-primary text-xl">Valore</label>
                                    <input type="text" name="value" readonly class="form-control" aria-label="value" value="{{old('value', $memberFrequency->value ?? null)}}">
                                </div>
                                <div class="col-md-2 mt-4">
                                    <label for="credits_earned_date" class="form-label badge badge-primary text-xl">Acquisizione</label>
                                    <input type="text" name="credits_earned_date" readonly class="form-control" aria-label="credits_earned_date" value="{{old('credits_earned_date', substr($memberFrequency->credits_earned_date,0,10) ?? null)}}">
                                </div>
                                <div class="col-md-2 mt-4">
                                    <label for="delete" class="form-label badge badge-primary text-xl">Elimina corso</label>
                                    <br>
                                    <button class="payment_delete_button no-button" data-id="{{$memberFrequency->id}}"><i id="red" class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<button type="submit" class="btn btn-primary">Salva</button>



    <!-- Modal -->
    <div class="modal fade" id="addQuotaModal" tabindex="-1" aria-labelledby="addQuotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="margin-top: 40px" class="row">

                                <b>Aggiungi quota</b>
                                <br>
                                <br>
                                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">
                                <div class="col-md-6">
                                    <label for="payment_reason" class="form-label badge badge-primary text-xl">Descrizione movimento</label>
                                    <input type="text" id="payment_reason" class="form-control" aria-label="payment_reason">
                                    <div id="payment_reason_alert" class="alert alert-danger hidden" role="alert"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="amount" class="form-label badge badge-primary text-xl">Quota</label>
                                    <input type="number" id="amount" class="form-control" aria-label="amount">
                                    <div id="amount_alert" class="alert alert-danger hidden" role="alert"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="paid_amount" class="form-label badge badge-primary text-xl">Data</label>
                                    <input type="date" id="date" class="form-control" aria-label="date">
                                    <div id="date_alert" class="alert alert-danger hidden" role="alert"></div>
                                </div>
                                <div style="margin-top: 40px" class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    <button type="button" id="save" class="btn btn-primary">Salva</button>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            $(".rm").remove();

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
                    $("#value").append($("<option class='rm' selected></option>").attr("value", '').text('-'));
                    $("#value").append($("<option class='rm' ></option>").attr("value", response.course_credits).text(response.course_credits));
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
            let notes = $('[name="notes_no_credits"]').val();

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
                    credits_earned_date:credits_earned_date,
                    notes:notes
                },
                success:function(response){
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

        $('.delete-discipline').on('click',function(e){
            e.preventDefault();
            let discipline_id = $(this).data('id');
            let member_id = $('#member_id').val();
            $('#discipline_error').removeClass('display');

            $.ajax({
                url: "/discipline/delete/",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    member_id:member_id,
                    discipline_id:discipline_id
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

        $('.payment_delete_button').on('click',function(e){
            e.preventDefault();
            let frequency_id = $(this).data('id');
            $.ajax({
                url: "/frequency/delete",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    frequency_id:frequency_id,
                },
                success:function(response){
                    if(response == 1){
                        location.reload();
                    }
                },
                error: function(response) {

                },
            });
        });

        $('.delete-quota').on('click',function(e){
            e.preventDefault();
            let payment_id = $(this).data('id');
            $('#discipline_error').removeClass('display');

            $.ajax({
                url: "/quota/delete/",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    payment_id:payment_id
                },
                success:function(response){
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

        $('#save-committee').on('click',function(e){
            e.preventDefault();
            let member_id = $('#member_id').val();
            let committee_id = $('#committee_id').val();
            let charge_type_id = $('#charge-type-id').val();

            $('#study-group-error').removeClass('display');

            $.ajax({
                url: "/committee/add/",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    member_id:member_id,
                    committee_id:committee_id,
                    charge_type_id:charge_type_id
                },
                success:function(response){
                    if(response.committee_id != undefined)
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

        $('.delete-study-group').on('click',function(e){
            e.preventDefault();
            let member_id = $('[name="member_id"]').val();
            let study_group_id = $('[name="study_group_id"]').val();

            $.ajax({
                url: "/study-group/delete/",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    member_id:member_id,
                    study_group_id:study_group_id
                },
                success:function(response){
                    if(response == 1){
                        location.reload();
                    }
                },
                error: function(response) {

                },
            });
        });



    </script>
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

        $('[name="member_role"]').on('change', function(){
            let selected = $('[name="member_role"] option:selected').val();
            if(selected == 2){
                let value = $('[name="course_credits"]').val();

                $('[name="value"]')
                    .find('option')
                    .remove()
                    .end()

                for(var i = (1); i <= value; i += 0.5)
                $('[name="value"]')
                    .append($("<option></option>")
                    .attr("value", i)
                    .text(i));
            }
            if(selected != 2) {
                let value = $('[name="course_credits"]').val();

                $('[name="value"]')
                    .find('option')
                    .remove()
                    .end()

                $('[name="value"]')
                    .append($("<option>0</option>")
                        .attr("value", 0)
                        .text(0));
                $('[name="value"]')
                    .append($("<option>-</option>")
                        .attr("value", '-')
                        .text('-'));
                $('[name="value"]')
                    .append($("<option>"+value+"</option>")
                        .attr("value", value)
                        .text(value));
            }
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
    </script>
</div>
