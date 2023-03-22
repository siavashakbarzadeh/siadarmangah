<?php

namespace App\Http\Controllers;

use App\Models\MemberReceipt;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentTypePivot;
use App\Permissions\Permission;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'date-start' => $request->query('date-start'),
            'date-end' => $request->query('date-end'),
            'paymentMethod' => $request->query('payment-method'),
        ];

        if(empty($request->query('date-start')))
            $filters['date-start'] = Carbon::now()->firstOfYear();


        $receipts = MemberReceipt::
            join('member_payments','member_receipts.member_payment_id','=','member_payments.id')
            ->dateStart($filters['date-start'])
            ->dateEnd($request->query('date-end'))
            ->paymentMethod($request->query('payment-method'))
            ->paginate(10);
        $paymentsType = PaymentType::all();

        return view('receipts.receipts-list', [
            'receipts'=>$receipts,
            'paymentsType' => $paymentsType,
            'filters' => $filters
        ]);
    }

    public function download($receipt_id)
    {
        $receipt = MemberReceipt::find($receipt_id);
        return response()->download(storage_path(env('DOWNLOAD_URL').$receipt->path));
    }

    public function delete($receipt_id, FlasherInterface $flasher)
    {
        $payment = Payment::find($receipt_id);
        $paymentType = PaymentTypePivot::where('payment_id', $payment->id)->first();
        $receipt = MemberReceipt::where('member_payment_id', $payment->id)->first();
        $paymentTypeDelete = $paymentType->delete();
        File::delete(storage_path(env('DOWNLOAD_URL').$payment->receipt->path));
        $receiptDelete = $receipt->delete();
        if($receiptDelete && $paymentTypeDelete)
        {
            $payment->payed_amount = 0;
            $payment->paid = null;
            $payment->payment_date = null;
            $payment->save();

            $flasher->addSuccess('Ricevuta eliminata', 'Operazione conclusa con successo');
            return redirect(route('receipts-list'));
        }
    }
}
