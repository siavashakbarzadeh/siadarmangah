<?php

namespace App\Jobs;

use App\Models\Committee;
use App\Models\Member;
use App\Models\QuotaSent;
use App\Models\StudyGroup;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class SendQuotas implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $region;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($region)
    {
        $this->region = $region;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $frequencies = [];
        $members = Member::whereHas('position', function($query){
           $query->where('member_type','<>','Partecipante ECM');
           $query->where('region_id',$this->region);
        })->where('members.status',0)->get();
        $studyGroups = StudyGroup::all();
        $committess = Committee::all();
        foreach($members as $member)
        {
            if($member->consent == 0)
            {
                //Invia modulo privacy
                //storage_path('app/public/attachments/Informativa.pdf');
            }

            //creates member card
            $pdf = pdf::loadView('pdf.member-card', compact('member', 'studyGroups', 'committess'))
                ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
            //Check if folder exists
            $path = storage_path('app/public/attachments/'.(Carbon::now()->format('Y')-1));
            if(!File::isDirectory($path))
            {
                File::makeDirectory($path,0777,true,true);
            }

            $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')-1).'/scheda_' . $member->name . '_' .$member->surname. '.pdf'));
            //

            $sent = new QuotaSent();
            $sent->member_id = $member->id;
            $sent->name = $member->name;
            $sent->surname = $member->surname;
            $sent->email = $member->email;
            $sent->scheda_path = 'attachments/'.(Carbon::now()->format('Y')-1).'/scheda_'. $member->name . '_' .$member->surname. '.pdf';
            $sent->courses_path = NULL;
            $sent->year = (Carbon::now()->format('Y')-1);
            $sent->region = $this->region;

            if($member->frequencies->isNotEmpty())
            {
                foreach($member->frequencies as $frequency)
                {
                    if(Carbon::parse($frequency->credits_earned_date)->format('Y') == (Carbon::now()->format('Y')-1) && $frequency->credits_earned_date != NULL)
                    {
                        $frequencies [] = [
                            'place' => $frequency->course->place,
                            'start' => $frequency->course->start,
                            'course' => $frequency->course->course,
                            'value' => $frequency->value,
                        ];
                    }
                }
                if(!empty($frequencies)){
                    $pdf = pdf::loadView('pdf.courses-list', compact('member', 'frequencies'))
                        ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
                    $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')-1).'/corsi_' . $member->name . '_' .$member->surname. '.pdf'));
                    $sent->courses_path = 'attachments/'.(Carbon::now()->format('Y')-1).'/corsi_'. $member->name . '_' .$member->surname. '.pdf';
                }
                $frequencies = [];
            }

            $sent->save();
        }
    }
}
