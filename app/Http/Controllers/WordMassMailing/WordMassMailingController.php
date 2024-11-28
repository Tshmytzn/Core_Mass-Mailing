<?php

namespace App\Http\Controllers\WordMassMailing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\AccountModel;
use App\Models\SignatureModel;
use App\Models\MailRecordModel;
use App\Mail\WordMassMailing;
use App\Models\LeadRecords;
use App\Models\EmailTemplate;
class WordMassMailingController extends Controller
{
    public function sendMassEmail(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array', // Ensure ids is an array
            'service' => 'required|string', // Ensure service is a string
        ]);

        $leadIds = $request->ids; // Array of lead IDs
        $service = $request->service; // Selected service type

        
        foreach ($leadIds as $leadId) {

            $mailto = LeadRecords::where('lead_id', $leadId)->first();
           

            $user = AccountModel::where('acc_id', session('acc_id'))->first();
            $fromName = $user->acc_fullname;
            $fromEmail = $user->acc_email;

            $signature = SignatureModel::where('acc_id', session('acc_id'))->first();
            $cleanedSignature = $signature ? $signature->sig_body : '';

            $history = new MailRecordModel();
            $history->acc_id = session('acc_id');
            $history->lead_id = $leadId;
            $history->mr_type = 'Word';
            $history->save();
            
            if($mailto->lead_status == '1'){
                $mailto->lead_status += 1;
                $mailto->save();
                $temp = EmailTemplate::where('temp_type', $service)->where('temp_followup','false')->first();
            }else{
                $mailto->lead_status += 1;
                $mailto->save();
                $temp = EmailTemplate::where('temp_type', $service)->where('temp_followup', 'true')->first();  
            }
            
            Mail::to($mailto->lead_email)->queue(
                new WordMassMailing($fromEmail, $fromName, $mailto->lead_firstname,$temp->temp_subject,$temp->temp_body, $cleanedSignature)
            );
            
        }

        return response()->json(['message' => 'Email Successfully Queued', 'status' => 'success']);
    }
}
