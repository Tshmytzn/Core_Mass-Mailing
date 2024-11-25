<?php

namespace App\Http\Controllers\BrochureMassMailing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SingleMailerWithHtml;
use App\Mail\SingleMailerWithHtmlv2;
use App\Mail\SingleMailerWithHtmlv3;
use App\Models\AccountModel;
use App\Models\SignatureModel;
use App\Models\MailRecordModel;
use App\Models\LeadRecords;

class BrochureMassMailingController extends Controller
{
    public function BrochureMassMailing(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array', // Ensure ids is an array
            'service' => 'required|string', // Ensure service is a string
        ]);

        $leadIds = $request->ids; // Array of lead IDs
        $service = $request->service; // Selected service type

        foreach ($leadIds as $leadId) {

            $mailto = LeadRecords::where('lead_id',$leadId)->first();
            $mailto->lead_status = '1';
            $mailto->save();

            $user = AccountModel::where('acc_id', session('acc_id'))->first();
            $fromName = $user->acc_fullname;
            $fromEmail = $request->mailfrom;

            $signature = SignatureModel::where('acc_id', session('acc_id'))->first();
            $cleanedSignature = $signature ? $signature->sig_body : '';

            $history = new MailRecordModel();
            $history->acc_id = session('acc_id');
            $history->lead_id = $leadId;
            $history->mr_type = 'Brochure';
            $history->save();

            if ($service == 'Software Development'||$service == 'Startup MVP') {
                $subject = 'Building software tools at low cost for your business';
                Mail::to($mailto->lead_email)->queue(
                    new SingleMailerWithHtml($subject, $fromEmail, $fromName, $cleanedSignature)
                );
            } elseif ($service == 'BPO' || $service == 'Remote Employee Management') {
                $subject = 'Cost savings with your customer service operations';
                Mail::to($mailto->lead_email)->queue(
                    new SingleMailerWithHtmlv2($subject, $fromEmail, $fromName, $cleanedSignature)
                );
            } else {
                $subject = 'Cost savings with your IT support';
                Mail::to($mailto->lead_email)->queue(
                    new SingleMailerWithHtmlv3($subject, $fromEmail, $fromName, $cleanedSignature)
                );
            }

        }

        return response()->json(['message' => 'Email Successfully Queued', 'status' => 'success']);
    }
    public function BrochureMassMailingHistory(){

        $history = MailRecordModel::join('leads_record', 'mail_record.lead_id', '=', 'leads_record.lead_id')
            ->where('mr_type', 'Brochure')
            ->select('leads_record.*') // Select all fields from leads_record
            ->get();

        return response()->json(['data' => $history]);

    }
}
