<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Permissions\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function addToUser(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'role' => 'required',
            'user_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }
        $user = User::find($request->user_id);
        return $user->assignRole($request->role);
    }
}
