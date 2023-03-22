<?php

namespace App\Http\Controllers;

use App\Custom\CategoryRepository;
use App\Custom\DisciplinesRepository;
use App\Custom\ProfessionRepository;
use App\Custom\YoSidRepository;
use App\Models\Discipline;
use App\Models\DisciplineMember;
use App\Models\Export;
use App\Models\JuniorCategory;
use App\Models\Member;
use App\Models\MemberCategory;
use App\Models\Payment;
use App\Models\Position;
use App\Models\Profession;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $ordinaryMembers = Position::where('member_type', 'Ordinario')
            ->count();
        $ecmMembers = Position::where('member_type', 'Partecipante ECM')
            ->count();
        $yosidMembers = Member::where('yo_sid', 1)->count();
        $under40 = Member::join('positions','members.id','=','positions.member_id')
            ->whereYear('birth_date','>=', (Carbon::now()->format('Y')-40))
            ->where('positions.member_type','Ordinario')
            ->where('status', 0)
            ->count();
        $payments = Payment::where('payed_amount','>',0)
            ->whereYear('date','=',Carbon::now()->format('Y'))
            ->orWhere('payment_date','>=',Carbon::now()->format('Y-m-d'))
            ->sum('payed_amount')
        ;

        $YoSidRepository = new YoSidRepository();
        $yoSidStats = [];
        foreach (JuniorCategory::all() as $category){
            $yoSidStats[$category->category] = $YoSidRepository->getYoSid($category->category);
        }

        $categoryRepository = new CategoryRepository();
        $categoryStats = [];
        foreach (MemberCategory::all() as $category){
            $categoryStats[$category->type] = $categoryRepository->getCategory($category->id);
        }

        $professionRepository = new ProfessionRepository();
        $professionsStats = [];
        foreach(Profession::all() as $profession){
            $professionsStats[$profession->profession] = $professionRepository->getProfession($profession->id);
        }
        $disciplinesRepository = new DisciplinesRepository();
        $disciplinesStats = [];
        foreach (Discipline::all() as $discipline){
            $disciplinesStats[$discipline->discipline] = $disciplinesRepository->getDiscipline($discipline->id);
        }

        $stats = [
            'ordinary' => $ordinaryMembers,
            'ecm' => $ecmMembers,
            'yosid' => $yosidMembers,
            'under40'=>$under40,
            'payments' => $payments
        ];
        $types = [
            'underForty' => [0,1],
            'yosid' => [0,1],
            'member_type' => ['Ordinario', 'Partecipante ECM']
        ];

        return view('dashboard.dashboard', [
            'stats' => $stats,
            'types' => $types,
            'disciplinesStats' => $disciplinesStats,
            'professionsStats' => $professionsStats,
            'categoryStats' => $categoryStats,
            'yoSidStats' => $yoSidStats
            ]);
    }

    public function download()
    {
        return response()->download(storage_path(env('DOWNLOAD_URL').'export/export-soci.xlsx'));
    }
}
