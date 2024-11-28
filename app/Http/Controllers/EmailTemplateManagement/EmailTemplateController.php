<?php

namespace App\Http\Controllers\EmailTemplateManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountModel;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function AddTemplate(Request $request){
        $validated = $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|string',
        ]);

        $check = EmailTemplate::where('temp_type', $validated['type'])->where('temp_followup','false')->first();
        if($check){
            $check->delete();
        }

        $body = $validated['body'];

        $body = str_replace('name', '{$name}', $body);

        $subject = $validated['subject'];
        
        $template = new EmailTemplate();
        $template->acc_id = session('acc_id');
        $template->temp_subject = $subject;
        $template->temp_body = $body;
        $template->temp_type = $validated['type'];
        $template->save();

        // Return a success response
        return response()->json([
            'message' => 'Template saved successfully!',
            'template' => $template
        ]);
    }

    public function GetTemplate(Request $request){
        $data = EmailTemplate::where('acc_id', session('acc_id'))->get();
        return response()->json([
            'data' => $data
            ]);
    }
}
