<?php

namespace App\Http\Controllers\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SingleMailer;
use App\Mail\SingleMailerWithHtml;
use App\Mail\SingleMailerWithHtmlv2;
use App\Mail\SingleMailerWithHtmlv3;
use App\Mail\SingleMailerWithHtmlv4;
use App\Models\AccountModel;
use App\Models\SignatureModel;
use App\Models\SingleMailHistory;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSingleMail extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'message' => $request->body,
        ];

        // Get the user data
        $user = AccountModel::where('acc_id', session('acc_id'))->first();
        $fromName = $user->acc_fullname;

        // Get the signature data and clean the body
        $signature = SignatureModel::where('acc_id', session('acc_id'))->first();
        $cleanedSignature = $signature ? $signature->sig_body : '';

        $subject = $request->subject;
        $fromEmail = $request->mailfrom;

        // Save the email history
        $history = new SingleMailHistory();
        $history->acc_id = session('acc_id');
        $history->smh_mailto = $request->mailto;
        $history->smh_content = $request->body;
        $history->smh_subject = $subject;
        $history->smh_date = Carbon::now('Asia/Hong_Kong')->format('Y-m-d');
        $history->smh_type = 'Word';
        $history->save();

        // Queue the email
        Mail::to($request->mailto)->queue(
            new SingleMailer($details, $subject, $fromEmail, $fromName, $cleanedSignature)
        );

        return response()->json(['message' => 'Email Successfully Queued', 'status' => 'success']);
    }


    public function sendEmailWithHTMl(Request $request)
    {
        $user = AccountModel::where('acc_id', session('acc_id'))->first();
        $fromName = $user->acc_fullname;
        $subject = $request->subject;
        $fromEmail = $request->mailfrom;

        $signature = SignatureModel::where('acc_id', session('acc_id'))->first();
        $cleanedSignature = $signature ? $signature->sig_body : '';

        $history = new SingleMailHistory();
        $history->acc_id = session('acc_id');
        $history->smh_mailto = $request->mailto;
        $history->smh_content = $subject;
        $history->smh_date = Carbon::now('Asia/Hong_Kong')->format('Y-m-d');
        $history->smh_type = 'Brochure';
        $history->save();

        if ($request->flexRadioDefault == '1') {
            Mail::to($request->mailto)->queue(
                new SingleMailerWithHtml($subject, $fromEmail, $fromName, $cleanedSignature)
            );
        } elseif ($request->flexRadioDefault == '2') {
            Mail::to($request->mailto)->queue(
                new SingleMailerWithHtmlv2($subject, $fromEmail, $fromName, $cleanedSignature)
            );
        } elseif ($request->flexRadioDefault == '3') {
            Mail::to($request->mailto)->queue(
                new SingleMailerWithHtmlv3($subject, $fromEmail, $fromName, $cleanedSignature)
            );
        } else {
            Mail::to($request->mailto)->queue(
                new SingleMailerWithHtmlv4($subject, $fromEmail, $fromName, $cleanedSignature)
            );
        }

        return response()->json(['message' => 'Email Successfully Queued', 'status' => 'success']);
    }


    public function GetSingleMailWord(){
        $data = SingleMailHistory::where('acc_id',session('acc_id'))->where('smh_type','Word')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=>$data]);
    }
    public function GetSingleMailBrochure(){
        $data = SingleMailHistory::where('acc_id',session('acc_id'))->where('smh_type','Brochure')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=>$data]);
    }
}
