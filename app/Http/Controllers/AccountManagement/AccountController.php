<?php

namespace App\Http\Controllers\AccountManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Hash;
class AccountController extends Controller
{
    public function UpdateAccount(Request $request)
    {
        // Check if the session has 'acc_id'
        if (!session('acc_id')) {
            return response()->json(['message' => 'User not authenticated'], 401);  // Unauthorized
        }

        // Retrieve the account by the session 'acc_id'
        $data = AccountModel::where('acc_id', session('acc_id'))->first();

        // If account is not found
        if (!$data) {
            return response()->json(['message' => 'Account not found'], 404);  // Not Found
        }

        // Update fields
        $data->acc_email = $request->input('email');
        $data->acc_fullname = $request->input('fullname');
        $data->acc_company_id = $request->input('company_id');
        $data->acc_username = $request->input('username');

        // If password is provided, hash and update it
        if ($request->has('password') && $request->password) {
            $data->acc_password = Hash::make($request->password);
        }

        // Save the updated data
        $data->save();

        // Return success response
        return response()->json(['message' => 'Account updated successfully'], 200);  // Success
    }

    public function UpdateAccountProfile(Request $request)
    {
        $account = AccountModel::where('acc_id', session('acc_id'))->first();

        if ($request->hasFile('userimage')) {
            $image = $request->file('userimage');

            // Validate the image (optional)
            $request->validate([
                'userimage' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($account->acc_pic && file_exists(public_path('acc_profile_picture/updated/' . $account->acc_pic))) {
                unlink(public_path('acc_profile_picture/updated/' . $account->acc_pic));
            }

            // Generate a unique name for the image and store it in the public directory
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('acc_profile_picture/updated'), $imageName);

            // Save the image name in the database (if necessary)
            $account->acc_pic = $imageName;
            $account->save();
        }

        return response()->json(['message' => 'Account updated successfully']);
    }

    public function GetAccount(){
        $account = AccountModel::where('acc_id', session('acc_id'))->first();
        return response()->json($account);
    }
}
