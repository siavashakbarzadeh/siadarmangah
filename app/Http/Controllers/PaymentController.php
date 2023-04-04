<?php

namespace App\Http\Controllers;

use App\Custom\NumberToLetterConverter;
use App\Mail\SendReceipt;
use App\Models\FailedAddQuota;
use App\Models\Member;
use App\Models\MemberReceipt;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentTypePivot;
use App\Models\Region;
use App\Permissions\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
            ->select('members.*', 'positions.member_type')
            ->where('positions.member_type', '<>', 'Partecipante ECM')
            ->searchByString($request->query('q'))
            ->whereNull('members.deleted_at')
            ->sortable()
            ->paginate(35);

        return view('payment.payment-list', ['members' => $members]);
    }

    public function history(Request $request)
    {
        $datesFilter = [
            'start'=>$request->query('date-start'),
            'end' => $request->query('date-end'),
            'payment_method' => $request->query('payment-method'),
            'region' => $request->query('region'),
        ];

        if(empty($request->query('date-start')))
            $datesFilter['start'] = Carbon::now()->format('Y');
        if(empty($request->query('payment-method')))
            $datesFilter['payment-method'] = 0;
        if(empty($request->query('region')))
            $datesFilter['region'] = 0;

        if($datesFilter['region'] == 0){
            $payments = DB::table('member_payments')
                ->where('member_payments.payed_amount','>',0)
                ->join('members', 'member_payments.member_id', '=', 'members.id')
                ->join('positions', 'member_payments.member_id', '=', 'positions.member_id')
                ->whereDate('member_payments.date', '>=', Carbon::parse($datesFilter['start'])->format('Y-m-d'))
                ->whereDate('member_payments.date', '<=', Carbon::parse($datesFilter['end'])->format('Y-m-d'))
                ->where('member_payments.payment_type_id','=', $datesFilter['payment_method'])
                ->orderBy('date','ASC')
                ->paginate(30);

            $paymentsTotal = DB::table('member_payments')
                ->where('member_payments.payed_amount','>',0)
                ->join('members', 'member_payments.member_id', '=', 'members.id')
                ->join('positions', 'member_payments.member_id', '=', 'positions.member_id')
                ->whereDate('member_payments.date', '>=', Carbon::parse($datesFilter['start'])->format('Y-m-d'))
                ->whereDate('member_payments.date', '<=', Carbon::parse($datesFilter['end'])->format('Y-m-d'))
                ->where('member_payments.payment_type_id','=', $datesFilter['payment_method'])
                ->sum('payed_amount');
        } else {
            $payments = DB::table('member_payments')
                ->where('member_payments.payed_amount','>',0)
                ->join('members', 'member_payments.member_id', '=', 'members.id')
                ->join('positions', 'member_payments.member_id', '=', 'positions.member_id')
                ->whereDate('member_payments.date', '>=', Carbon::parse($datesFilter['start'])->format('Y-m-d'))
                ->whereDate('member_payments.date', '<=', Carbon::parse($datesFilter['end'])->format('Y-m-d'))
                ->where('member_payments.payment_type_id','=', $datesFilter['payment_method'])
                ->where('positions.region_id',$datesFilter['region'])
                ->orderBy('date','ASC')
                ->paginate(30);

            $paymentsTotal = DB::table('member_payments')
                ->where('member_payments.payed_amount','>',0)
                ->join('members', 'member_payments.member_id', '=', 'members.id')
                ->join('positions', 'member_payments.member_id', '=', 'positions.member_id')
                ->whereDate('member_payments.date', '>=', Carbon::parse($datesFilter['start'])->format('Y-m-d'))
                ->whereDate('member_payments.date', '<=', Carbon::parse($datesFilter['end'])->format('Y-m-d'))
                ->where('member_payments.payment_type_id','=', $datesFilter['payment_method'])
                ->where('positions.region_id',$datesFilter['region'])
                ->sum('payed_amount');
        }

        $paymentsType = PaymentType::all();
        $regions = Region::all();

        return view('payment.history-list', [
            'payments'=>$payments,
            'paymentsTotal' => round($paymentsTotal,2),
            'paymentsType' => $paymentsType,
            'regions' => $regions,
            'datesFilter' => $datesFilter
        ]);
    }

    public function list(Request $request, $id)
    {

        $paymentsType = PaymentType::all();
        $payments = [];
        $paymentsSum = 0;
        $quotasSum = 0;
        $quotaToPay = Payment::where('member_id',$id)
            ->where('year', null)
            ->orderBy('date', 'ASC')
            ->get();
        $paidQuotas = Payment::where('member_id',$id)
            ->whereNotNull('year')
            ->orderBy('date', 'ASC')
            ->get();

        foreach($paidQuotas as $quota){
            if(Str::contains($quota->payment_reason,'Quota anno')){
                $yearToSearch = substr($quota->payment_reason, 11);
                $payment = Payment::where('member_id',$id)
                    ->where('year', $yearToSearch)->get();
                if(!is_null($payment)){
                    $payments[] = $quota;
                    $paymentsSum += $quota->payed_amount;
                    $quotasSum += $quota->amount;
                }
            }
        }

        $receipts = MemberReceipt::where('member_receipts.member_id', $id)
            ->join('member_payments','member_receipts.member_payment_id','=','member_payments.id')
            ->dateStart($request->query('date-start'))
            ->dateEnd($request->query('date-end'))
            ->paymentMethod($request->query('payment-method'))
            ->paginate(10);

        return view('payment.payment-add', [
            'paymentsType' => $paymentsType,
            'payments' => $payments,
            'receipts' => $receipts,
            'paymentsSum' => $paymentsSum,
            'quotasSum' => $quotasSum,
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payments' => ['required','array','min:1'],
            'payments.*' => ['required','array:payment_id,date,payment_reason,payed_amount,payment_type'],
            'payments.*.payment_id' => ['required'],
            'payments.*.date' => ['required'],
            'payments.*.payment_reason' => ['required'],
            'payments.*.payed_amount' => ['required'],
            'payments.*.payment_type' => ['required'],
        ]);

        if($validator->fails()){
            return redirect()->back();
        }
        $paymentsData = [];
        foreach($request->payments as $paymentData) {
            $payment = Payment::find($paymentData['payment_id']);
            $payment->payment_type_id = $paymentData['payment_type'];
            $payment->payed_amount = $paymentData['payed_amount'];
            $payment->payment_date = $paymentData['date'];
            $payment->paid = 1;
            $payment->paymentType()->attach([$paymentData['payment_type']]);
            $payment->save();
            $converter = new NumberToLetterConverter();
            $payment_amount_letter = $converter->to_word($paymentData['payed_amount'],"EUR");
            $paymentsData[] = [
                'date' => $payment->date,
                'payed_amount' => $payment->payed_amount,
                'payment_amount_letter' => $payment_amount_letter,
                'payment_method' => PaymentType::find($paymentData['payment_type'])->type,
                'member_name' => $payment->member->name,
                'member_surname' => $payment->member->surname,
                'member_qualification' => $payment->member->qualification
            ];
        }

        $receipt = new MemberReceipt();
        $receipt->member_id = $payment->member_id;
        $receipt->member_payment_id = $payment->id;
        $receipt->path = 'receipts/ricevuta_' . $request->payments[array_key_first($request->payments)]['payment_id'] . '.pdf';
        $receipt->sent = 0;
        $receipt->save();
/*
        $pdf = pdf::loadView('pdf.member-receipt', compact('payment'))
         ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf->save(storage_path('app/public/receipts/ricevuta_' . $request->payments[array_key_first($request->payments)]['payment_id'] . '.pdf'));*/

        return redirect(route('payment-list', $payment->member_id));
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'receipt_id' => 'required',
            'member_id' => 'required'
        ]);

        if($validator->fails()){
            return $validator->messages();
        }
        $data['receipt_id'] = $request->receipt_id;
        $data['member_id'] = $request->member_id;

        $receipt = MemberReceipt::where('member_payment_id','=',$request->receipt_id)->first();
        $member = Member::find($request->member_id);

        Mail::mailer('mailgun-luisa')->send('email.receipt', $data, function($message)use($data, $receipt) {
            $message->to('l.perrupane@siditalia.it')
                ->subject('SID - Ricevuta pagamento');
            $message->attach(storage_path(env('DOWNLOAD_URL').$receipt->path));
        });
        $receipt->sent = 1;
        $receipt->save();
    }
    public function test()
    {
        return view('pdf.test-receipts');
    }


    public function visualizzaPdf($payment)
    {
        $payment = Payment::query()->findOrFail($payment);
        return pdf::loadView('pdf.member-receipt',compact('payment'))->download();
    }

    public function deleteReceipt($receipt_id, FlasherInterface $flasher)
    {
        $payment = Payment::query()->findOrFail($receipt_id);
        $paymentType = PaymentTypePivot::where('payment_id', $payment->id)->first();
        $receipt = MemberReceipt::where('member_payment_id', $payment->id)->first();
        $paymentTypeDelete=null;
        $receiptDelete=null;
        if ($paymentType){
            $paymentTypeDelete = $paymentType->delete();
        }
        if ($receipt){
            $receiptDelete = $receipt->delete();
        }

        File::delete(storage_path(env('DOWNLOAD_URL').optional($payment->receipt)->path));

        if($receiptDelete && $paymentTypeDelete)
        {
            $payment->payed_amount = 0;
            $payment->paid = null;
            $payment->payment_date = null;
            $payment->save();
            $member = Member::find($payment->member_id);
            activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha eliminato una ricevuta di '.$member->name.' '.$member->surname);
            $flasher->addSuccess('Ricevuta eliminata', 'Operazione conclusa con successo');
            return redirect(route('payment-list', $payment->member_id));
        }else{
            return redirect()->route('payment-list',$payment->member_id);
        }
    }


    public function detail($id)
    {
        $payment = Payment::findOrFail($id);
        return $payment;
    }

    public function newYear()
    {
        $failedQuotas = FailedAddQuota::all();
        return view('payment.new-year', ['failedQuotas' => $failedQuotas]);
    }
}
