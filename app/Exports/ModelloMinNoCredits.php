<?php

namespace App\Exports;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ModelloMinNoCredits implements FromView, WithColumnWidths, WithStyles
{
    public int $id;

    public function __construct(int $id){
        $this->id = $id;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.modellomin-no-credits', [
            'course' => Course::find($this->id)
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 15,
            'E' => 15,
            'F' => 30,
            'G' => 15,
            'H' => 20,
            'I' => 15,
            'J' => 15,
            'K' => 15
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $borders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin'
                ]
            ]
        ];

        $sheet->getStyle('A2:D2')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D8D8D8']]);
        $sheet->getStyle('A2:D2')->applyFromArray($borders);
        $sheet->getStyle('A3:D3')->applyFromArray($borders);
        $sheet->getStyle('A4:K4')->applyFromArray($borders);
        $sheet->getStyle('A5:K6')->applyFromArray($borders);
        $sheet->getStyle('A7:J300')->applyFromArray($borders);
        $sheet->getStyle('A5:E5')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D8D8D8']]);
        $sheet->getStyle('I5:K5')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D8D8D8']]);
        $sheet->getStyle('A8:E8')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D8D8D8']]);
        $sheet->getStyle('I8:J8')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D8D8D8']]);
        for($n = 1;$n <= 400;$n++){
            $sheet->getRowDimension($n)->setRowHeight(20);
        }
        $sheet->getRowDimension(2)->setRowHeight(55);
        $sheet->getRowDimension(5)->setRowHeight(65);
        $sheet->getRowDimension(8)->setRowHeight(65);
        $sheet->getRowDimension(1)->setRowHeight(40);
        $sheet->getRowDimension(4)->setRowHeight(40);
        $sheet->getRowDimension(7)->setRowHeight(40);
        $sheet->getStyle('A1:K400')->getAlignment()->setHorizontal('center');
    }

}
