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
                <h1 class="h3 mb-2 text-gray-800">Sponsor</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
{{--        @can('add-company')--}}
        <a href="{{route('company-new')}}"> <h6 class="m-0 font-weight-bold text-primary text-right">Aggiungi Sponsor <span> <i class="fas fa-user-plus"></i> </span> </h6>   </a>
{{--        @endcan--}}
    </div>
    <div class="card-body">
        <div class="row mt-3 mb-3">

        </div>
        <div id="table-container" class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modifica</th>
                    <th>Elimina</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{$company->companyName}}</td>
                        <td class="text-center">
{{--                            @can('add-company')--}}
                            <a class="member-icons" href="{{route('company-detail', $company->id)}}"> <i class="fas fa-edit"> </i> </a>
{{--                            @endcan--}}
                        </td>
                        <td>
{{--                            @can('add-company')--}}
                            <form method="post" action="{{route('company-delete', $company->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="red" class="member-icons no-button"> <i class="fas fa-trash-alt"></i> </button>
                            </form>
{{--                            @endcan--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$companies->links()}}
    </div>
</div>

<script>
    $("#search").one("click", function(e){
        let markup = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'><thead><h3>Risultati della ricerca</h3><tr><th>Titolo</th><th>Cognome</th><th>Nome</th><th>Data di nascita</th><th>Codice fiscale</th><th>Email</th><th>Azioni</th></tr> </thead> <tbody class='table-body'> <tr><td></td> <td></td> <td></td> <td></td> <td></td> <td></td><td class='text-center'> <a class='member-icons' href=''> <i class='fas fa-plus-square'></i></a></td> </tr></tbody></table>";
        $("#table-container").prepend(markup);
    });

    $("#search").keyup(function(e){
        let searchString = $("#search").val();
        $(".table-body").empty();
        $.ajax({
            url: "/member/search",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                "search_string":searchString,
                "type":"members"
            },
            success:function(response){
                response.members.forEach(function(member){
                    let markup = "<tr><td>"+member.qualification+"</td><td>"+member.surname+"</td><td>"+member.name+"</td><td>"+member.birth_date+"</td><td>"+member.fiscal_code+"</td><td>"+member.email+"</td><td class='text-center'><a class='member-icons' href='/member/detail/"+member.id+"'><i class='fas fa-plus-square'> </i></a></td></tr>";
                    $(".table-body").append(markup)
                });
            },
            error: function(response) {

            },
        });
    });
</script>

            </div>
        </div>
    </div>
</div>
@include('common.footer')

