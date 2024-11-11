<?php

namespace App\Http\Controllers\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SingleMailer;
use Illuminate\Support\Facades\Mail;

class SendSingleMail extends Controller
{
    public function sendEmail(request $request)
    {
        $details = [
            'title' => $request->title,
            'message' => $request->body
        ];
        $subject = 'test';
        $fromEmail = 'jp@coresupporthub.com';
        Mail::to($request->mail)->send(new SingleMailer($details,$subject, $fromEmail));

        return redirect()->back();
    }
}
