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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Causale</th>
                                <th>Quota</th>
                                <th>Importo pagato</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($payments as $payment)
                                @if($payment->payed_amount <= 0 || $payment->payed_amount == null)
                                <tr class="autocompile" data-id="{{$payment->id}}">
                                    <td>{{\Carbon\Carbon::parse($payment->date)->format('d-m-Y')}}</td>
                                    <td>{{$payment->payment_reason}}</td>
                                    <td>{{round($payment->amount)}}</td>
                                    <td class="{{$payment->payed_amount == 0 ? 'table-warning' : 'table-success'}}">{{round($payment->payed_amount, 2)}}</td>
                                </tr>
                                @endif
                            @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="custom-text-bold">Saldo</td>
                                    <td class="{{(($quotasSum - $paymentsSum) != 0) ? 'table-danger' : 'table-success'}}">{{(($quotasSum - $paymentsSum) == 0) ? 0 : '-'.$quotasSum - $paymentsSum}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h3>Aggiungi pagamento</h3>
                                <div class="table-responsive">
                                    <form action="{{route('add-payment')}}" method="POST">
                                        @csrf
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Causale</th>
                                                <th>Descrizione</th>
                                                <th>Importo</th>
                                                <th>Tipo di pagamento</th>
                                                <th>Azioni</th>
                                            </tr>
                                            </thead>

                                            <tbody id="add-row">
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><button class="btn btn-primary">Aggiungi pagamento</button></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h3>Ricevute</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <form method="GET">
                                        <thead>
                                        <tr>
                                            <th>
                                                <label>Data da</label>
                                                <input name="date-start" class="form-control" type="date" />
                                            </th>
                                            <th>
                                                <label>Data a</label>
                                                <input name="date-end" class="form-control" type="date" />
                                            </th>
                                            <th>
                                                <label>Metodo di pagamento</label>
                                                <select name="payment-method" class="form-control">
                                                    @foreach($paymentsType as $paymentType)
                                                        <option selected></option>
                                                        <option value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th><button class="btn btn-primary">Filtra</button></th>
                                        </tr>
                                        <tr>
                                            <th>Data pagamento</th>
                                            <th>Stato spedizione</th>
                                            <th>Stampa</th>
                                            <th>Invia</th>
                                            <th>Visualizza</th>
                                            <th>Scarica</th>
                                            <th>Elimina</th>
                                        </tr>
                                        </thead>
                                        </form>
                                        <tbody>
                                            @foreach($receipts as $receipt)
                                                <tr class="{{(\Carbon\Carbon::parse($receipt->payment->payment_date)->format('d-m-Y') == \Carbon\Carbon::today()->format('d-m-Y')) ? 'last-receipts' : ''}}">
                                                    <td> <input value="{{\Carbon\Carbon::parse($receipt->payment->payment_date)->format('d-m-Y')}}" class="form-control" type="text" readonly /> </td>
                                                    <td>
                                                        <input value="{{($receipt->sent == 0) ? 'Non inviata' : 'Inviata'}}"
                                                               class="form-control {{($receipt->sent == 0) ? 'table-danger' : 'table-success'}}"
                                                        />
                                                    </td>
                                                    <td> <i data-path="{{\Illuminate\Support\Facades\Storage::url($receipt->path)}}" class="fas fa-print printer pointer blue-link"></i> </td>
                                                    <td> <i onclick="send({{$receipt->id}},{{$receipt->member_id}})" class="fas fa-envelope pointer blue-link"></i> </td>
                                                    <td> <a href="{{route('payment.visualizza-pdf',$receipt->id)}}"> <i class="fas fa-desktop"></i> </a> </td>
                                                    <td><a href="{{route('download-receipt', $receipt->id)}}"> <i class="fas fa-download"></i> </a> </td>
                                                    <td>

                                                        <form action="{{route('delete-receipt', $receipt->id)}}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
    $('.autocompile').on('click',function(e){
        let payment_id = $(this).data('id');

        $.ajax({
            url: "/payment/detail/"+payment_id,
            type:"GET",
            success:function(response){
                let payment_reason = response.payment_reason;
                let amount = response.amount;
                addRow(payment_reason, amount, payment_id);
            },
            error: function(response) {

            },
        });
    });

    let added_ids = [];
    let checkContains;
    function addRow(payment_reason, amount, payment_id)
    {
        //let idObject = {'id':payment_id};
        checkContains = added_ids.includes(payment_id);
        if(!checkContains)
        {
            const date = new Date();

            let currentDate = new Date().toJSON().slice(0, 10);
            added_ids.push(payment_id);
            let markup = "<tr>"+
                "<td>"+"<input type='hidden' name='payments["+payment_id+"][payment_id]' value='"+payment_id+"'/>"+"<input name='payments["+payment_id+"][date]' class='form-control' type='date' value='"+currentDate+"' />"+"</td>"+
                "<td>"+"<input  value='"+payment_reason+"' name='payments["+payment_id+"][payment_reason]' class='form-control' />"+"</td>"+
                "<td>"+"<select>"+"<option value='a saldo'>Saldo quota/e</option>"+ "<option>Contributo alla ricerca scientifica</option>"+"</select>"+"</td>"+
                "<td>"+"<input class='form-control' name='payments["+payment_id+"][payed_amount]' value='"+amount+"' type='number'  />"+"</td>"+
                "<td>"+"<select name='payments["+payment_id+"][payment_type]' class='form-select form-select-md col form'>"+"@foreach($paymentsType as $paymentType)"+"<option value='{{$paymentType->id}}'>{{$paymentType->type}}</option>"+"@endforeach"+"</select>"+"</td>"+
                "</tr>";
            $("#add-row").prepend(markup);
        }
    }

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
