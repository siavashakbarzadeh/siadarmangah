<div>
<a wire:click="export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="pr-2 fas fa-download fa-sm text-white-50"></i>Report</a>

    @if($exporting && !$exportFinished)
        <div class="alert alert-primary text-medium" role="alert" wire:poll="updateExportProgress">
            Export avviato, sarà pronto a breve
        </div>

    @endif

    @if($exportFinished)
        <div class="alert alert-success text-medium" role="alert">
            Export pronto. Scaricalo <a href="{{route('dash_download')}}" class="alert-link">qui</a>
        </div>
    @endif

</div>
