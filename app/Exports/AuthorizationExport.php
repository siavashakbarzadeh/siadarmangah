<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class AuthorizationExport implements FromView, WithColumnWidths, ShouldQueue
{
    public function __construct()
    {

    }

    public function view(): \Illuminate\Contracts\View\View
    {
            $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
                ->select('members.*', 'positions.member_type')
                ->where('positions.member_type', '=', 'Ordinario')
                ->where('members.consent', 0)
                ->whereNull('members.deleted_at')->get();

        return view('exports.members', [
            'members' => $members
        ]);
    }

    public function query()
    {
        return Member::query();
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 10,
            'G' => 20,
            'H' => 20,
            'I' => 40,
            'J' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 30,
            'O' => 20,
            'P' => 20,
            'Q' => 10,
            'R' => 10,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'W' => 20,
            'X' => 20
        ];
    }
}
