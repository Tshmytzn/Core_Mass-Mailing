<?php

namespace App\Http\Controllers\SignatureManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountModel;
use App\Models\SignatureModel;

class SignatureController extends Controller
{
    public function AddSignature(request $request){

        $signature = new SignatureModel();
        $signature->acc_id = session('acc_id');
        $signature->sig_body = $request->content;
        $signature->save();

        return response()->json(['message' => 'Signature Added Successfully']);
    }
}
