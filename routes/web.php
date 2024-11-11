<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMail\SendSingleMail;

Route::get('/', function () {
    return view('massmailer.index');
});

Route::get('/mail/sendsinglemail', function () {
    return view('SendMail');
})->name('SendMail');

Route::post('/sendEmail', [SendSingleMail::class, 'sendEmail'])->name('sendEmail');
