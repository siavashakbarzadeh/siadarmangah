<?php

namespace App\Http\Controllers;

use App\Mail\SendPec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function testSmtp()
    {
        $email = Mail::to('test-u54k8unwm@srv1.mail-tester.com')->send(new SendPec());

        dd($email);
    }
}
