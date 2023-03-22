<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class MembersExport implements FromView, WithColumnWidths, ShouldQueue
{
    public string $ordinary;
    public int $yosid;

    public function __construct($ordinary, $yosid, $underForty)
    {
        $this->ordinary = $ordinary;
        $this->yosid = $yosid;
        $this->underForty = $underForty;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        if($this->underForty){
            $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
                ->select('members.*', 'positions.member_type')
                ->where('positions.member_type', '=', $this->ordinary)
                ->whereYear('birth_date','>=', (Carbon::now()->format('Y')-40))
                ->whereNull('members.deleted_at')->get();
        } else{
            $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
                ->select('members.*', 'positions.member_type')
                ->where('positions.member_type', '=', $this->ordinary)
                ->where('members.yo_sid', '=', $this->yosid)
                ->whereNull('members.deleted_at')->get();
        }

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
