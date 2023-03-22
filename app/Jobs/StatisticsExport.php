<?php

namespace App\Jobs;

use App\Exports\MembersExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class StatisticsExport implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $ordinary;
    public int $yosid;
    public int $underForty;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ordinary, $yosid, $underForty)
    {
        $this->ordinary = $ordinary;
        $this->yosid = $yosid;
        $this->underForty = $underForty;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $type = $this->ordinary;
        if($this->underForty)
            $type = 'under-40';
        if($this->yosid)
            $type = 'yo-sid';
        File::delete(storage_path(env('DOWNLOAD_URL').'export/export-soci.xlsx'));
        Excel::store(new MembersExport($this->ordinary, $this->yosid, $this->underForty),'export-soci.xlsx','export');
    }
}
