<?php

namespace App\Http\Controllers\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SingleMailer;
use App\Mail\SingleMailerWithHtml;
use App\Mail\SingleMailerWithHtmlv2;
use App\Mail\SingleMailerWithHtmlv3;
use App\Models\AccountModel;
use App\Models\SignatureModel;
use Illuminate\Support\Facades\Mail;

class SendSingleMail extends Controller
{
    public function sendEmail(request $request)
    {
        $details = [
            'message' => $request->body
        ];

        // Get the user data
        $user = AccountModel::where('acc_id', session('acc_id'))->first();
        $fromName = $user->acc_fullname;

        // Get the signature data and clean the body
        $signature = SignatureModel::where('acc_id', session('acc_id'))->first();

        // Check if the signature exists and clean the body
        $cleanedSignature = $signature ? $signature->sig_body : '';

        $subject = $request->subject;
        $fromEmail = $request->mailfrom;

        // Send the email
        Mail::to($request->mailto)->send(new SingleMailer($details, $subject, $fromEmail, $fromName, $cleanedSignature));

        return response()->json(['message' => 'Email Successfully Sent', 'status' => 'success']);
    }

    public function sendEmailWithHTMl(request $request)
    {
        $user = AccountModel::where('acc_id', session('acc_id'))->first();
        $fromName = $user->acc_fullname;
        $subject = $request->subject;
        $fromEmail = $request->mailfrom;

        $signature = SignatureModel::where('acc_id', session('acc_id'))->first();

        // Check if the signature exists and clean the body
        $cleanedSignature = $signature ? $signature->sig_body : '';

        if($request->flexRadioDefault=='1'){
            Mail::to($request->mailto)->send(new SingleMailerWithHtml($subject, $fromEmail, $fromName, $cleanedSignature));
        }else if($request->flexRadioDefault=='2'){
            Mail::to($request->mailto)->send(new SingleMailerWithHtmlv2($subject, $fromEmail, $fromName, $cleanedSignature));
        }else{
            Mail::to($request->mailto)->send(new SingleMailerWithHtmlv3($subject, $fromEmail,$fromName, $cleanedSignature));
        }

        
        return response()->json(['message' => 'Email Successfully Send', 'status' => 'success']);
    }
}
