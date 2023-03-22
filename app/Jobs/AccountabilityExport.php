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

class AccountabilityExport implements ShouldQueue
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
    public function __construct() {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        File::delete(storage_path(env('DOWNLOAD_URL').'export/situazione-contabile-soci.xlsx'));
        Excel::store(new \App\Exports\AccountabilityExport(),'situazione-contabile-soci.xlsx','export');
    }
}
