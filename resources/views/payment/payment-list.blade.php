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
                <h1 class="h3 mb-2 text-gray-800">Registrazione pagamenti</h1>

                <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-12">
                            <form method="get">
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-6">
                                        <label>Cerca</label>
                                        <input autocomplete="off" id="search" name="q" class="form-control" type="text">
                                        <input type="hidden" id="type" value="">
                                        <div style="display: none;" id="display-results" class="alert alert-primary" role="alert">

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Cerca</label>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Cerca</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="table-container" class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>@sortablelink('surname', 'Cognome')</th>
                                <th>@sortablelink('name', 'Nome')</th>
                                <th>Data di nascita</th>
                                <th>Codice fiscale</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Titolo</th>
                                <th>@sortablelink('surname', 'Cognome')</th>
                                <th>@sortablelink('name', 'Nome')</th>
                                <th>Data di nascita</th>
                                <th>Codice fiscale</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{$member->qualification}}</td>
                                    <td>{{$member->surname}}</td>
                                    <td>{{$member->name}}</td>
                                    <td>{{substr($member->birth_date,0, 10)}}</td>
                                    <td>{{$member->fiscal_code}}</td>
                                    <td>{{$member->email}}</td>
                                    <td class="text-center">
                                        @can('add-payment')
                                        <a class="member-icons" href="{{route('payment-list', $member->id)}}"> <i class="fas fa-plus-square"> </i></a>
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
            {{$members->links()}}
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
        let type = 'members';

        $("#display-results").empty();
        $.ajax({
            url: "/member/search",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                "q":searchString,
                "type":type
            },
            success:function(response){
                $("#display-results").css("display","block");
                response.members.forEach(function(member){
                    let markup = "<p style='cursor:pointer' onclick=compile('"+member.fiscal_code+"') style='height: 20px'>"+member.surname+" "+member.name+" - <span>"+member.fiscal_code+"</span></p>";
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
    function compile(fiscal_code)
    {
        $("#search").val(fiscal_code);
    }
</script>
@include('common.footer')
