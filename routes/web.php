<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMail\SendSingleMail;
use App\Http\Controllers\AccountManagement\loginController;
use App\Http\Controllers\AccountManagement\AccountController;
use App\Http\Middleware\AccountAuthMiddleware;

Route::middleware([AccountAuthMiddleware::class])->group(function () {

    Route::get('/', function () {
        return view('massmailer.index');
    })->name('home');

    Route::get('/mailing/single', function () {
        return view('massmailer.MailingPage');
    })->name('singlemail');

    Route::get('/mailing/single/brochure', function () {
        return view('massmailer.SingleMailBrochure');
    })->name('singlemailbrochure');

    Route::get('/setting', function () {
        return view('massmailer.Setting');
    })->name('Setting');

    Route::get('/mail/sendsinglemail', function () {
        return view('SendMail');
    })->name('SendMail');

    Route::get('/mailing/loading', action: function () {
        return view('massmailer.components.loadingpage');
    })->name('loading');

    Route::get('/mailing/emailtemplate', action: function () {
        return view('MailWithHtml.Building_Software_Apps');
    })->name('mailTemplate');

    Route::post('/Logout', [loginController::class, 'Logout'])->name('Logout');

    // single mail
    Route::post('/sendEmail', [SendSingleMail::class, 'sendEmail'])->name('sendEmail');
    Route::post('/sendEmailWithHTMl', [SendSingleMail::class, 'sendEmailWithHTMl'])->name('sendEmailWithHTMl');

    // userData
    Route::post('/updateuserdata', [AccountController::class, 'UpdateAccount'])->name('UpdateAccount');
    Route::post('/UpdateAccountProfile', [AccountController::class, 'UpdateAccountProfile'])->name('UpdateAccountProfile');
    Route::get('/GetAccount', [AccountController::class, 'GetAccount'])->name('GetAccount');
});

Route::get('/login', function () {
    return view('massmailer.Login');
})->name('login');

Route::post('/login/submit', [loginController::class, 'login'])->name('login.submit');
