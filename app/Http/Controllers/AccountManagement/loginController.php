<?php

namespace App\Http\Controllers\AccountManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('username');
        $password = $request->input('password');

        // Attempt to find account by username
        $account = AccountModel::where('acc_username', $email)->first();

        if ($account) {
            // Check if the password is correct
            if (Hash::check($password, $account->acc_password)) {
                // Save account information to session, e.g., user ID
                session(['acc_id' => $account->acc_id]);

                // Redirect to the home route
                return redirect()->route('home');
            } else {
                // Password doesn't match
                return redirect()->route('login')->with('error', 'Incorrect Email or Password');
            }
        } else {
            // Account not found
            return redirect()->route('login')->with('error', 'Account not found');
        }
    }

    public function Logout(){
        session()->flush();
        return redirect()->route('login');
    }

}
