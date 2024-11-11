<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMail\SendSingleMail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail/sendsinglemail', function () {
    return view('SendMail');
})->name('SendMail');

Route::post('/sendEmail', [SendSingleMail::class, 'sendEmail'])->name('sendEmail');
