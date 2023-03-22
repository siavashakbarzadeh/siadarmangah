<?php

namespace App\Http\Livewire;

use App\Exports\MembersExport;
use App\Jobs\StatisticsExport;
use Livewire\Component;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false;
    public $type;
    public $yosid;
    public $underForty;

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;

        $batch = Bus::batch([
            new StatisticsExport($this->type, $this->yosid, $this->underForty)
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }


    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function render()
    {
        return view('livewire.export');
    }
}
