<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Region;
use App\Models\StudyGroup;
use App\Models\User;
use App\Permissions\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{
    public function index()
    {
//        if(!auth()->user()->can(Permission::CAN_ACCESS_SETTINGS)){
//            abort(403);
//        }
        $studyGroups = StudyGroup::all();
        $regions = Region::all();
        $disciplines = Discipline::all();
        $roles = Role::all();
        $users = User::all();

        return view('settings.index',[
            'studyGroups' => $studyGroups,
            'regions' => $regions,
            'disciplines' => $disciplines,
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function smtp()
    {
        $email = config('mail.from.address');
        $name = config('mail.from.name');
        $host = config('mail.from.host');
        $port = config('mail.from.port');
        $encryption = config('mail.from.encryption');
        return view('settings.smtp', [
            'email' => $email,
            'name' => $name,
            'host' => $host,
            'port' => $port,
            'encryption' => $encryption
        ]);
    }
}
