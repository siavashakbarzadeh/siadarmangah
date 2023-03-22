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
                <h1 class="h3 mb-2 text-gray-800">Storico pagamenti</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <label class="text-primary">Totale pagamenti per l'anno {{\Carbon\Carbon::parse($datesFilter['start'])->format('Y')}}</label>
                                        <p><b>€ {{$paymentsTotal}}</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body">
                        <form method="GET">
                        <div class="row  mb-4">
                            <div class="col-md-3">
                                <label>Data da</label>
                                <input name="date-start" class="form-control" type="date" value="{{$datesFilter['start']}}"/>
                            </div>
                            <div class="col-md-3">
                                <label>Data a</label>
                                <input name="date-end" class="form-control" type="date" value="{{$datesFilter['end']}}" />
                            </div>
                            <div class="col-md-2">
                                <label>Metodo di pagamento</label>
                                <select name="payment-method" class="form-control">
                                    <option value="0">Tutti</option>
                                    @foreach($paymentsType as $paymentType)
                                        @if(app('request')->input('payment-method') == $paymentType->id)
                                        <option value="{{$paymentType->id}}" selected>{{$paymentType->type}}</option>
                                        @else
                                        <option value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Regione</label>
                                <select name="region" class="form-control">
                                    <option value="0">Tutte le regioni</option>
                                    @foreach($regions as $region)
                                        @if(app('request')->input('region') == $region->id)
                                        <option value="{{$region->id}}" selected>{{$region->region}}</option>
                                        @else
                                        <option value="{{$region->id}}">{{$region->region}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
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
                                    <th>Importo</th>
                                    <th>Regione</th>
                                    <th>Metodo di pagamento</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td> <input value="{{\Illuminate\Support\Carbon::parse($payment->date)->format('d-m-Y')}}" class="form-control" type="text" readonly /> </td>
                                        <td>{{$payment->surname ?? ''}}</td>
                                        <td>{{$payment->name ?? ''}}</td>
                                        <td>{{round($payment->payed_amount,2)}}</td>
                                        <td>
                                            <select disabled name="region_id" class="form-control">
                                                @foreach($regions as $region)
                                                    @if($region->id == $payment->region_id)
                                                        <option value="{{$region->id}}" selected>{{$region->region}}</option>
                                                    @else
                                                        <option value="{{$region->id}}">{{$region->region}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select disabled name="payment-method" class="form-control">
                                                @foreach($paymentsType as $paymentType)
                                                    @if($paymentType->id == $payment->payment_type_id)
                                                        <option value="{{$paymentType->id}}" selected>{{$paymentType->type}}</option>
                                                    @else
                                                        <option value="{{$paymentType->id}}">{{$paymentType->type}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{$payments->appends([
                'date-start' => $datesFilter['start'],
                'date-end' => $datesFilter['end'],
                'payment-method' => $datesFilter['payment-method'],
                'region' => $datesFilter['region'],
                ])->links()}}
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

</script>
@include('common.footer')
