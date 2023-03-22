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
                <h1 class="h3 mb-2 text-gray-800">Ricevute</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <form method="GET">
                        <div class="row  mb-4">
                            <div class="col-md-3">
                                <label>Data da</label>
                                <input name="date-start" class="form-control" type="date" value="{{$filters['date-start']}}"/>
                            </div>
                            <div class="col-md-3">
                                <label>Data a</label>
                                <input name="date-end" class="form-control" type="date" value="{{$filters['date-end']}}" />
                            </div>
                            <div class="col-md-3">
                                <label>Metodo di pagamento</label>
                                <select name="payment-method" class="form-control">
                                    <option value="">Selezione un metodo di pagamento</option>
                                    @foreach($paymentsType as $paymentType)
                                        @if($paymentType->id == $filters['paymentMethod'])
                                            <option selected value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                        @else
                                            <option value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Filtra</label><br>
                                <button class="btn btn-primary">Filtra</button>
                            </div>
                        </div>
                        </form>
                        <div id="table-container" class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                   <th>Data</th>
                                    <th>Cognome</th>
                                    <th>Nome</th>
                                    <th>Stato</th>
                                    <th>Metodo di pagamento</th>
                                    <th>Stampa</th>
                                    <th>Invia</th>
                                    <th>Visualizza</th>
                                    <th>Download</th>
                                    <th>Elimina</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($receipts as $receipt)
                                    <tr>
                                        <td> <input value="{{\Illuminate\Support\Carbon::parse($receipt->payment->payment_date)->format('d-m-Y')}}" class="form-control" type="text" readonly /> </td>
                                        <td>{{$receipt->payment->member->surname ?? null}}</td>
                                        <td>{{$receipt->payment->member->name ?? null}}</td>
                                        <td>
                                            <input value="{{($receipt->sent == 0) ? 'Non inviata' : 'Inviata'}}"
                                                   class="form-control {{($receipt->sent == 0) ? 'table-danger' : 'table-success'}}"
                                            />
                                        </td>
                                        <td>
                                            <select disabled name="payment-method" class="form-control">
                                                @foreach($paymentsType as $paymentType)
                                                    @if($paymentType->id == $receipt->payment->payment_type_id)
                                                        <option value="{{$paymentType->id}}" selected>{{$paymentType->type}}</option>
                                                    @else
                                                        <option value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <i data-path="{{\Illuminate\Support\Facades\Storage::url($receipt->path)}}" class="fas fa-print printer pointer blue-link"></i> </td>
                                        <td><i onclick="send({{$receipt->id}},{{$receipt->member_id}})" class="fas fa-envelope pointer blue-link"></i></td>
                                        <td> <a href="{{\Illuminate\Support\Facades\Storage::url($receipt->path)}}" target="_blank"> <i class="fas fa-desktop"></i> </a> </td>
                                        <td><a href="{{route('download-receipt', $receipt->id)}}"> <i class="fas fa-download"></i> </a> </td>
                                        <td>
                                            <form action="{{route('delete-receipt-list', $receipt->id)}}">
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
            {{$receipts->links()}}
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

    function send(receipt_id, member_id){

        Swal.fire({
            title: 'Confermi di voler inviare la ricevuta via email?',
            showDenyButton: true,
            confirmButtonText: 'Conferma',
            denyButtonText: `Annulla`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: "/receipt/send/",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        receipt_id:receipt_id,
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
