<?php

namespace App\Jobs;

use App\Models\FailedAddQuota;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentTypePivot;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddQuotas implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
            ->select('members.*', 'positions.member_type')
            ->where('positions.member_type', '<>', 'Partecipante ECM')
            ->whereNull('members.deleted_at')
            ->get();

        foreach ($members as $member) {
            switch ($member){

                case $member->position->member_type == 'Onorario':
                    $memberQuota = 0;
                    $this->saveQuota($memberQuota, $member);
                    break;

                case ($member->position->member_category == 6 && $member->birth_date >= (Carbon::now()->format('Y')-40)):
                    $memberQuota = 35;
                    $position = Position::where('member_id',$member->id)->first();
                    $position->quota = $memberQuota;
                    $position->save();
                    $this->saveQuota($memberQuota, $member);
                    break;

                case ($member->position->member_category == 6 && $member->birth_date <= (Carbon::now()->format('Y')-40)):
                    $memberQuota = 75;
                    $member = Member::find($member->id);
                    $position = Position::where('member_id',$member->id)->first();
                    $position->save();
                    if($member)
                    {
                        $member->yo_sid = 0;
                        $position->member_category = 2;
                        $position->quota = $memberQuota;
                        $member->save();
                        $position->save();
                        $this->saveQuota($memberQuota, $member);
                    }
                    break;

                case ($member->position->member_category == 9 && Carbon::parse($member->position->expire)->format('Y-m-d') > Carbon::now()->format('Y-m-d')):
                    $memberQuota = 10;
                    $position = Position::where('member_id',$member->id)->first();
                    $position->quota = $memberQuota;
                    $position->save();
                    $this->saveQuota($memberQuota, $member);
                    break;

                case $member->position->member_category == 7:
                case $member->position->member_category == 10:
                    $memberQuota = 35;
                    $position = Position::where('member_id',$member->id)->first();
                    $position->quota = $memberQuota;
                    $position->save();
                    $this->saveQuota($memberQuota, $member);
                    break;

                case $member->position->member_category == 8:
                    $memberQuota = 60;
                    $position = Position::where('member_id',$member->id)->first();
                    $position->quota = $memberQuota;
                    $position->save();
                    $this->saveQuota($memberQuota, $member);
                    break;

                case $member->position->member_category == 11:
                    $memberQuota = 0;
                    $position = Position::where('member_id',$member->id)->first();
                    $position->quota = $memberQuota;
                    $position->save();
                    $this->saveQuota($memberQuota, $member);
                    break;

                case $member->position->member_category == 9 && Carbon::parse($member->position->expire)->format('Y-m-d') < Carbon::now()->format('Y-m-d') && $member->position->profession_id == 2:
                    //check for change category
                    $memberQuota = 35;
                    $member = Member::find($member->id);
                    $position = Position::where('member_id',$member->id)->first();
                    if($member)
                    {
                        $position->member_category = 6;
                        $position->sub_category = null;
                        $position->quota = $memberQuota;
                        $position->expire = (Carbon::parse($member->birth_date)->format("Y") + 40) . "-" . Carbon::parse($member->birth_date)->format("m") . "-" . Carbon::parse($member->birth_date)->format("d");
                        $position->save();
                        $this->saveQuota($memberQuota, $member);
                    }
                    break;

                case $member->position->member_category == 9 && Carbon::parse($member->position->expire)->format('Y-m-d') < Carbon::now()->format('Y-m-d') && $member->position->profession_id != 2:
                    $memberQuota = 35;
                    $member = Member::find($member->id);
                    $position = Position::where('member_id',$member->id)->first();
                    if($member)
                    {
                        $position->member_category = 7;
                        $position->quota = $memberQuota;
                        $position->expire = '';
                        $position->save();
                        $this->saveQuota($memberQuota, $member);
                    }
                    break;

                default:
                    $memberQuota = 75;
                    $this->saveQuota($memberQuota, $member);
            }
        }
    }

    public function saveQuota($memberQuota, $member):void
    {
        $payment = new Payment();
        $payment->member_id = $member->id;
        $payment->payment_type_id = 1;
        $payment->payed_amount = 0;
        $payment->date = Carbon::now();
        $payment->payment_reason = 'Quota anno '.Carbon::now()->format('Y');
        $payment->amount = $memberQuota;
        $payment->year = Carbon::now()->format('Y');
        if($payment->save())
        {
            $payment->paymentType()->attach(1);
        } else {
            $failed = new FailedAddQuota();
            $failed->member_id = $payment->amount;
            $failed->payment_date = Carbon::now();
            $failed->save();
        }
    }
}

