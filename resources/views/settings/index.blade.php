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
                            <h6 class="m-0 font-weight-bold text-primary">Gruppi di studio</h6>
                        </div>
                        <div class="card-body">
                            <label>Aggiungi gruppo di studio</label>
                            <input class="form-control mb-2" type="text" name="study_group">
                            <button id="add_study_group" class="btn btn-sm btn-primary mb-2">Aggiungi</button>
                            <div id="table-container" class="table-responsive vertical-scroll">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Elimina</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($studyGroups as $studyGroup)
                                        <tr>
                                            <td>{{$studyGroup->group}}</td>
                                            <td><i id="red" data-id="{{$studyGroup->id}}" class="fas fa-trash delete_study_group"></i></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


                    <div class="col-lg-3 col-md-3 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Regioni</h6>
                            </div>
                            <div class="card-body">
                                <label>Aggiungi regione</label>
                                <input class="form-control mb-2" type="text" name="region">
                                <button id="add_region" class="btn btn-sm btn-primary mb-2">Aggiungi</button>
                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Elimina</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($regions as $region)
                                            <tr>
                                                <td>{{$region->region}}</td>
                                                <td><i id="red" data-id="{{$region->id}}" class="fas fa-trash delete_region"></i></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Discipline</h6>
                            </div>
                            <div class="card-body">
                                <label>Aggiungi disciplina</label>
                                <input class="form-control mb-2" type="text" name="study_group">
                                <button id="add_discipline" class="btn btn-sm btn-primary mb-2">Aggiungi</button>
                                <div id="table-container" class="table-responsive vertical-scroll">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Elimina</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($disciplines as $discipline)
                                            <tr>
                                                <td>{{$discipline->discipline}}</td>
                                                <td><i id="red" data-id="{{$discipline->id}}" class="fas fa-trash delete_discipline"></i></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Ruoli</h1>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Assegna un ruolo a un utente</h6>
                            </div>
                            <div class="card-body">
                                <label>Utenti</label>
                                <select id="user" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} {{$user->surname}}</option>
                                    @endforeach
                                </select>

                                <label class="mt-2">Ruoli</label>
                                <select id="role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <button id="add_role" class="btn btn-sm btn-primary mb-2 mt-2">Aggiungi</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Utenti</h1>
                </div>

                <div class="row">
                    <form action="{{route('add-user')}}" method="POST">
                        @csrf
{{--                        <div class="col-lg-3 col-md-3 mb-4">--}}
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Aggiungi un nuovo utente</h6>
                                </div>
                                <div class="card-body">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" id="user_name"/>
                                    <label>Cognome</label>
                                    <input type="text" class="form-control" id="user_surname"/>
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="user_email"/>
                                    <label>Password</label>
                                    <input type="text" class="form-control" value="{{uniqid()}}" id="user_password"/>

                                    <button id="add_user" class="btn btn-sm btn-primary mb-2 mt-2">Aggiungi</button>
                                </div>
                            </div>
{{--                        </div>--}}
                    </form>

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
