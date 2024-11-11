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
            'message' => $request->body
        ];

        $subject = $request->subject;
        $fromEmail = $request->mailfrom;
        Mail::to($request->mailto)->send(new SingleMailer($details,$subject, $fromEmail));

        return redirect()->back();
    }
}
