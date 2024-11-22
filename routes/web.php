<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMail\SendSingleMail;
use App\Http\Controllers\AccountManagement\loginController;
use App\Http\Controllers\AccountManagement\AccountController;
use App\Http\Controllers\SignatureManagement\SignatureController;
use App\Http\Middleware\AccountAuthMiddleware;
use App\Http\Controllers\LeadsManagement\LeadsController;

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

    Route::get('/massmailing/brochure', function () {
        return view('massmailer.MassMailingBrochure');
    })->name('massmailigbrochure');

    Route::get('/massmailing/word', function () {
        return view('massmailer.MassMailingWord');
    })->name('massmailingword');

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
        return view('MailWithHtml.Remote_It');
    })->name('mailTemplate');


    // leads View
    Route::get('/leads/', function () {
        return view('massmailer.LeadsRecord');
    })->name('leadsrecord');


    
    Route::post('/Logout', [loginController::class, 'Logout'])->name('Logout');

    // single mail
    Route::post('/sendEmail', [SendSingleMail::class, 'sendEmail'])->name('sendEmail');
    Route::post('/sendEmailWithHTMl', [SendSingleMail::class, 'sendEmailWithHTMl'])->name('sendEmailWithHTMl');
    Route::get('/GetSingleMailWord', [SendSingleMail::class, 'GetSingleMailWord'])->name('GetSingleMailWord');
    Route::get('/GetSingleMailBrochure', [SendSingleMail::class, 'GetSingleMailBrochure'])->name('GetSingleMailBrochure');
    

    // userData
    Route::post('/updateuserdata', [AccountController::class, 'UpdateAccount'])->name('UpdateAccount');
    Route::post('/UpdateAccountProfile', [AccountController::class, 'UpdateAccountProfile'])->name('UpdateAccountProfile');
    Route::get('/GetAccount', [AccountController::class, 'GetAccount'])->name('GetAccount');

    // signature Data
    Route::post('/AddSignature', [SignatureController::class, 'AddSignature'])->name('AddSignature');
    Route::get('/GetSignature', [SignatureController::class, 'GetSignature'])->name('GetSignature');

    // leads Data
    Route::post('/InsertLeadsData', [LeadsController::class, 'InsertLeadsData'])->name('InsertLeadsData');
    Route::get('/GetLeadsData', [LeadsController::class, 'GetLeadsData'])->name('GetLeadsData');
    
});

Route::get('/login', function () {
    return view('massmailer.Login');
})->name('login');

Route::post('/login/submit', [loginController::class, 'login'])->name('login.submit');
