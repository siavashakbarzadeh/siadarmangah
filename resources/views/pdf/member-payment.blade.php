<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style>
        body {
            font-family: "Arial";
            margin: 0px;
            padding: 0px;
        }
        .container{
            margin: 10px auto 2px;


        }
        .row{

            width:100%;
            /*padding: 12px 0px;*/
            border: solid 1px black;
        }

        @media print {
            .no-print,
            .no-print * {
                display: none !important;
            }
        }


        table {
            width: 100%;
            position: relative;
            border-collapse: collapse;
        }

    </style>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>SB Admin 2 - Dashboard</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div style="width: 40%;min-height: auto; float: left;border-right: solid 1px black;">
            <p style="padding:3px;">
                <span style="width: 70%;float: left;margin-top: -4px;">
                    <span style="text-transform: uppercase;font-size: 10px;">conti correnti postali</span> -
                    <span style="text-transform: capitalize;font-size: 10px;">ricevuta di versamento </span>
                </span>
                <span style="width: 30%;float: right;font-size: 10px;">
                    <span style="float: right;">banco <b>posta</b></span>
                </span>
            </p>


        </div>
        <div style="width:60%;min-height: auto;float: left; ">
            <p style="padding: 3px;">
                <span style="width: 70%;float: left;margin-top: -4px;">
                    <span style="text-transform: uppercase;font-size: 10px;">conti correnti postali</span> -
                    <span style="text-transform: capitalize;font-size: 10px;">ricevuta di accredito </span>
                </span>
                <span style="width: 30%;float: right;font-size: 10px;">
                    <span style="float: right;">banco <b>posta</b></span>
                </span>
            </p>

        </div>
    </div>
    <div class="row">
{{--        40%--}}
                <div style="width: 40%;height: 350px; float: left;border-right: solid 1px black;">
                    <p style="padding: 2px 15px;">

                        <span class="bg-dark" style="display: inline-block; background: black;width: 25px;height: 25px;color: white;margin-top: 10px;
                        padding: 5px;text-align: center;font-size: 25px;">€</span>
                        <span>sul C/C n. &nbsp;&nbsp;&nbsp;&nbsp; <b>88043005</b></span>
                        <span style="margin-left: 70px;">di Euro &nbsp;&nbsp;<b>{{ round($balance) ?? ''}}</b>  </span>
                        <p style="text-transform: uppercase;font-size: 9px;padding:0px 11px;margin-top: -10px">
                        importo in lettere: <b style="padding-left: 10px;font-size: 11px;">{{ $converted ?? ''}}</b>
                        </p>

                        <fieldset style="border: solid 1px black;padding:1px 15px;margin:0px 10px;border-radius: 5px;height: 30px;">
                            <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">intestato a</b></legend>
                            <p style="font-weight: bold;font-size: 13px;text-transform: uppercase;font-weight: bolder;border-bottom: solid 1px black;">società italiana di diabetologia</p>

                        </fieldset>
                    <fieldset style="border: solid 1px black;padding: 1px 15px;margin:12px 10px;border-radius: 5px;height: 30px;">
                        <legend style="text-transform: uppercase;font-size: 8px;width: auto;"><b style="text-transform: uppercase;border: none;">causale</b></legend>
                        <p style="font-size: 13px;padding: 2px 30px;text-transform: none;border-bottom: solid 1px black;">pagamento quota/e associativale</p>

                    </fieldset>
                    <fieldset style="border: solid 1px black;padding:1px 10px;margin:12px 10px;border-radius: 5px;height:auto;width: 50%;">
                        <legend style="text-transform: uppercase;font-size: 8px;width: auto;"><b style="text-transform: uppercase;border: none;">eseguito da</b></legend>
                        <span style="width:100%;font-weight: bold;text-transform: capitalize;border-bottom: 1px solid black;font-size: 11px;padding-top: 0px;padding-bottom: 0px;display: inline-block">{{$member->surname ?? ''}} {{$member->name ?? ''}}</span>
                        <span style="width:100%;display:inline-block;text-transform: uppercase;font-size: 8px;font-weight: bolder;margin-top: 7px;padding-top: 0px;padding-bottom: 0px;">via-piazza</span>
                        <span style="width:100%;display:inline-block;font-weight: bold;text-transform: capitalize;border-bottom: 1px solid black;font-size: 11px;padding-top: 0px;padding-bottom: 0px;">{{$member->residence->residence ?? ''}}</span>
                        <span style="width:100%;display:inline-block;text-transform: uppercase;font-size: 8px;font-weight: bolder;margin-top: 7px;padding-top: 0px;padding-bottom: 0px;">cap</span>
                        <span style="width:100%;display:inline-block;font-weight: bold;text-transform: capitalize;border-bottom: 1px solid black;font-size: 11px;padding-top: 0px;padding-bottom: 0px;">{{$member->residence->cap ?? ''}}</span>
                        <span style="width:100%;display:inline-block;text-transform: uppercase;font-size: 8px;font-weight: bolder;margin-top:7px;padding-top: 0px;padding-bottom: 0px;">localita</span>
                        <span style="width:100%;display:inline-block;font-weight: bold;text-transform: capitalize;border-bottom: 1px solid black;font-size: 11px;padding-top: 0px;padding-bottom: 0px;">{{$member->residence->city ?? ''}}</span>

                    </fieldset>

                    </p>

                    <div style="margin:-22px 0px;padding: 4px;clear: both;font-weight: bold;height:20px;width: 96%;"  >
                    <span style="width: 100%;font-size: 8px;text-transform: uppercase;margin-right: 30px;list-style-type: none;font-weight: bold;text-align: right;">

                    <li style="margin-top: -20px;">bollo dell'ufficio postale</li>


                    </span>
                    </div>



{{--                    <div style="width: 100%;height:60px;border-right: solid 1px black;border-left: solid 1px black;border-bottom: solid 1px black;margin-top: 0px;">--}}

{{--                    </div>--}}
                 </div>

        <div style="width:60%;height: 350px;float: left;">
            <p style="padding: 2px 15px;">
{{--                <img src="../../../public/img/euro.jpeg" alt="" style="width: 30px;height: 30px;">--}}
                <span class="bg-dark" style="display: inline-block; background: black;width: 25px;height: 25px;color: white;margin-top: 10px;
                        padding: 5px;text-align: center;font-size: 25px;">€</span>
                <span>sul C/C n. &nbsp;&nbsp;&nbsp;&nbsp; <b>88043005</b></span>
                <span style="margin-left: 120px;">di Euro &nbsp;&nbsp;&nbsp;&nbsp;<b>{{ round($balance) ?? ''}}</b> </span>
            </p>
            <p style="text-transform: uppercase;font-size: 9px;padding:0px 11px;margin-top: -10px">
                <b style="font-weight: bolder;font-size: 14px;">TD &nbsp;&nbsp;123&nbsp;&nbsp;&nbsp; </b> importo in lettere: <b style="padding-left: 10px;font-size: 11px;">{{ $converted ?? ''}}</b>
            </p>
{{--            <p style="text-transform: uppercase;font-size: 9px;padding:-11px 11px;">--}}
{{--                <b style="font-weight: bolder;font-size: 14px;">TD &nbsp;123 </b>--}}
{{--                &nbsp;&nbsp;&nbsp;&nbsp;importo in lettere: <b style="padding-left: 10px;font-size: 11px;">{{ $converted ?? ''}}</b>--}}
{{--            </p>--}}
            <fieldset style="border: solid 1px black;padding: 1px 15px;margin:-5px 15px 3px  ;border-radius: 5px;max-height: 30px;">
            <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">intestato a</b></legend>
            <p style="font-weight: bold;font-size: 16px;padding: 2px 50px;text-transform: uppercase;font-weight: bolder;border-bottom: solid 1px black;">
                società italiana di diabetologia
            </p>

            </fieldset>
            <fieldset style="border: solid 1px black;padding: 1px 15px;margin:10px 15px;border-radius: 5px;max-height: 30px;">
                <legend style="text-transform: uppercase;font-size: 8px;width: auto;"><b style="text-transform: uppercase;border: none;">causale</b></legend>
                <p style="font-size: 14px;padding: 2px 100px;text-transform: none;border-bottom: solid 1px black;">pagamento quota/e associativale</p>
            </fieldset>
            <div style="height:90px;width: 30%;margin-left: 10px;float: left;padding-top:30px;text-align: center;">
            &nbsp;<b style="font-size: 20px;"></b>
            </div>

            <div style="height:auto;width: 65%;float: right;">
                <fieldset style="border: solid 1px black;padding:1px 15px;margin:-2px 15px;border-radius: 5px;max-height: 30px;">
                    <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">eseguito da</b></legend>
                    <p style="font-weight: bold;font-size: 14px;padding: 2px 50px;text-transform: uppercase;font-weight: bolder;border-bottom: solid 1px black;">
                        {{$member->surname ?? ''}} {{$member->name ?? ''}}
                    </p>

                </fieldset>
                <fieldset style="border: solid 1px black;padding:0px 10px;margin: 16px 15px;border-radius: 5px;max-height: 30px;">
                    <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">via-piazza</b></legend>
                    <p style="font-weight: 200;font-size: 11px;padding: 2px 50px;text-transform: uppercase;font-weight: bolder;">
                        {{$member->residence->residence ?? ''}}
                    </p>

                </fieldset>
                <div  style="padding:0px;margin: 20px 0px;height: auto;width:100%;">
                    <fieldset style="border: solid 1px black;padding:4px 0px;margin: -10px 10px 3px 15px;border-radius: 5px;height: 20px;width: 30%;">
                        <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">cap</b></legend>
                        <p style="font-weight: 200;font-size: 11px;padding: 2px 50px;text-transform: uppercase;">
                            {{$member->residence->cap ?? ''}}
                        </p>

                    </fieldset>
                    <fieldset style="border: solid 1px black;padding:4px 0px;margin: -33px 15px 3px 0px;border-radius: 5px;height: 20px;width: 60%;float: right">
                        <legend style="text-transform: uppercase;font-size: 9px;width: auto;"><b style="text-transform: uppercase;border: none;">localita</b></legend>
                        <p style="font-weight: 200;font-size: 11px;padding: 2px 20px;text-transform: uppercase;">
                            {{$member->residence->city ?? ''}}
                        </p>

                    </fieldset>
                </div>
            </div>

            <div style="margin:-48px 0px 0px; ;padding: -30px 4px 0px;clear: both;font-weight: bold;height:20px;width: 100%;"  >
                <span style="width: 40%;font-size: 8px;text-transform: uppercase;padding-left: 10px;list-style-type: none;font-weight: bold;">

                    <li>bollo dell'ufficio postale</li>

                    <li style="font-size: 7px;text-transform: none;padding-left: 15px;">codice bancoPosta</li>
                </span>
                <span style="width: 60%;font-size: 8px;text-transform: uppercase;padding-left: 10px;list-style-type: none;float: right;margin-top: -23px;font-weight: bold;">

                    <li>importante:non scrivere nella zona sottostcinte</li>

                    <li style="font-size: 7px;text-transform: none;padding-left: 84px;">importo in euro &nbsp;&nbsp;  numero conto &nbsp;&nbsp;  tipo documento</li>
                </span>
            </div>
{{--            <div style="width: 95%;padding-right:30px;border-right: solid 1px black;border-bottom: solid 1px black;height: 61px;clear: both;margin-top: -110px;font-weight: bold;font-size: 22px;text-align: right;">--}}
{{--                <span style="margin-top: 10px;display: inline-block;">123 ></span>--}}
{{--            </div>--}}
        </div>

    </div>

    <div style="position: fixed;top: 200px;right: -85px;width: 230px;height: 20px;transform: rotate(-90deg);font-size: 7px;">
        Mod CH 8 ter-Mod12409A-ed1/10-EP1902/EP1903-St.[3]
    </div>
</div>
<div >
    <div  style="width:97%;height:60px;margin-right:15px;margin-top: -1px;border-bottom: solid 1px black;border-right: solid 1px black;border-left: solid 1px black;">
        <div style="width: 40%;float: left;height: 60px;"></div>
        <div style="width: 60%;border-left: solid 1px black;float: right;height: 60px;margin-left: 1px;text-align: right;font-weight: bold;font-size: 10px;">
            <h3 style="display: inline-block;margin-right: 20px;line-height: 50px;font-size: 22px;">123 ></h3>
        </div>
    </div>
</div>
</body>
</html>
