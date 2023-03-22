<div class="card shadow mb-4">
    <div class="card-header py-3">
        @can('add-member')
        <a href="{{route('new-member')}}"> <h6 class="m-0 font-weight-bold text-primary text-right">{{$add_title}} <span> <i class="fas fa-user-plus"></i> </span> </h6>   </a>
        @endcan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">

                    @can('add-payment')
                        @livewire('export', ['type' => $types['member_type'][0], 'yosid'=>$types['yosid'][0],'underForty'=>$types['underForty'][0]])
                    @endcan
            </div>
        </div>
        <form method="get">
        <div class="row mt-3 mb-3">
            <div class="col-md-4">
                <label>Cerca</label>
                <input autocomplete="off" id="search" name="q" class="form-control" type="text">
                <input type="hidden" id="type" value="{{$type}}">
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
        <div id="table-container" class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Codice</th>
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
                    <th>Codice</th>
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
                        <td>{{$member->id}}</td>
                        <td>{{$member->qualification}}</td>
                        <td>{{$member->surname}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{Carbon\Carbon::parse($member->birth_date)->format('d-m-Y')}}</td>
                        <td>{{$member->fiscal_code}}</td>
                        <td>{{$member->email}}</td>
                        <td class="text-center">
                            @can('edit-member')
                            <a class="member-icons" href="{{route('member-detail', $member->id)}}"> <i class="fas fa-edit"> </i> </a>
                            <span> - </span>
                            <a id="red" class="member-icons" href="{{route('member-delete', $member->id)}}"> <i class="fas fa-trash-alt"></i> </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    $("#search").keyup(function(e){
        let searchString = $("#search").val();
        let type = 'members';
        if($("#type").val() == 'ecm'){
            type = 'ecm';
        }
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

@include('member.modal')

