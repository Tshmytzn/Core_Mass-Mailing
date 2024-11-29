<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMail\SendSingleMail;
use App\Http\Controllers\AccountManagement\loginController;
use App\Http\Controllers\AccountManagement\AccountController;
use App\Http\Controllers\SignatureManagement\SignatureController;
use App\Http\Middleware\AccountAuthMiddleware;
use App\Http\Controllers\LeadsManagement\LeadsController;
use App\Http\Controllers\BrochureMassMailing\BrochureMassMailingController;
use App\Http\Controllers\EmailTemplateManagement\EmailTemplateController;
use App\Http\Controllers\WordMassMailing\WordMassMailingController;
use App\Http\Controllers\DashboardAnalytics\AnalyticsController;

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

    Route::get('/template', function () {
        return view('massmailer.template');
    })->name('template');

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
    Route::post('/GetLeadsDataByService', [LeadsController::class, 'GetLeadsDataByService'])->name('GetLeadsDataByService');
    Route::post('/delete-lead', [LeadsController::class, 'deleteLead'])->name('deletelead');

    Route::post('/GetLeadsDataWordByService', [LeadsController::class, 'GetLeadsDataWordByService'])->name('GetLeadsDataWordByService');
    Route::post('/GetLeadsDataWordByServiceFollowUp', [LeadsController::class, 'GetLeadsDataWordByServiceFollowUp'])->name('GetLeadsDataWordByServiceFollowUp');
    Route::post('/ManualInsertLeadsdata', [LeadsController::class, 'ManualinputLeadsData'])->name('ManualinputLeadsData');

    //Brochure Mass Mailing
    Route::post('/BrochureMassMailing', [BrochureMassMailingController::class, 'BrochureMassMailing'])->name('BrochureMassMailing');
    Route::get('/BrochureMassMailingHistory', [BrochureMassMailingController::class, 'BrochureMassMailingHistory'])->name('BrochureMassMailingHistory');
    Route::get('/WordMassMailingHistory', [BrochureMassMailingController::class, 'WordMassMailingHistory'])->name('WordMassMailingHistory');

    //EmailTemplate
    Route::post('/AddTemplate', [EmailTemplateController::class, 'AddTemplate'])->name('AddTemplate');
    Route::post('/AddFollowupTemplate', [EmailTemplateController::class, 'AddFollowupTemplate'])->name('AddFollowupTemplate');
    Route::get('/GetTemplate', [EmailTemplateController::class, 'GetTemplate'])->name('GetTemplate');
    Route::get('/GetFollowupTemplate', [EmailTemplateController::class, 'GetFollowupTemplate'])->name('GetFollowupTemplate');

    //WordMassMailing
    Route::post('/sendMassEmail', [WordMassMailingController::class, 'sendMassEmail'])->name('sendMassEmail');
    Route::get('/getQueue', [WordMassMailingController::class, 'checkQueue'])->name('checkQueue');
    // Analytics
    Route::get('/getLeadsoverview', [AnalyticsController::class, 'getleadsoverview'])->name('getleadsoverview');
    Route::get('/getemailsoverview', [AnalyticsController::class, 'getemailsoverview'])->name('getemailsoverview');



});

Route::get('/login', function () {
    return view('massmailer.Login');
})->name('login');

Route::post('/login/submit', [loginController::class, 'login'])->name('login.submit');
