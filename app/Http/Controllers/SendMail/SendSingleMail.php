<?php

namespace App\Http\Controllers\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SingleMailer;
use App\Mail\SingleMailerWithHtml;
use App\Mail\SingleMailerWithHtmlv2;
use App\Mail\SingleMailerWithHtmlv3;
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

        return response()->json(['message' => 'Email Successfully Send', 'status' => 'success']);
    }
    public function sendEmailWithHTMl(request $request)
    {
        $subject = $request->subject;
        $fromEmail = $request->mailfrom;
        if($request->flexRadioDefault=='1'){
            Mail::to($request->mailto)->send(new SingleMailerWithHtml($subject, $fromEmail));
        }else if($request->flexRadioDefault=='2'){
            Mail::to($request->mailto)->send(new SingleMailerWithHtmlv2($subject, $fromEmail));
        }else{
            Mail::to($request->mailto)->send(new SingleMailerWithHtmlv3($subject, $fromEmail));
        }

        
        return response()->json(['message' => 'Email Successfully Send', 'status' => 'success']);
    }
}
