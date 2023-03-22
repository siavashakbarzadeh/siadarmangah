<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function add(Request $request)
    {
        if(!User::find(auth()->id())->can('app-settings')){
            abort(403);
        }
        $validator = Validator::make($request->all(),[
           'user_name' => 'required',
            'user_surname' => 'required',
            'email' => ['required','unique:users'],
            'user_password' => ['required', Rules\Password::defaults()]
        ]);
        if($validator->fails()){
            return $validator->messages();
        }
        return User::create([
            'name' => $request->user_name,
            'surname' => $request->user_surname,
            'email' => $request->email,
            'password' => Hash::make($request->user_password)
        ]);
    }
}
