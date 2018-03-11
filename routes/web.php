<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/account/verify', 'Account\VerificationController@showVerificationRequired')->name('account.needs_verification');
Route::get('/account/verify/resend', 'Account\VerificationController@resendVerification')->name('account.resend_verification');
Route::get('/account/verify/{token}', 'Account\VerificationController@attemptVerification')->name('account.attempt_verification');

Route::group(['middleware' => ['auth','email.verified'], 'prefix' => 'account'], function () {
    Route::get('/', 'Account\AccountController@show')->name('account');
});

Route::get('/me', 'Home\HomeController@index')->name('home');
