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
    Route::get('/update-email', 'Account\AccountEmailController@show')->name('account.update_email');
    Route::post('/update-email', 'Account\AccountEmailController@postUpdate');
    Route::get('/change-password', 'Account\AccountPasswordController@show')->name('account.change_password');
    Route::get('/add-mobile-number', 'Account\AccountMobileController@show')->name('account.add_mobile_number');
    Route::post('/add-mobile-number', 'Account\AccountMobileController@addMobileNumber');
    Route::get('/verify-mobile-number', function(){ return view('account.mobile.input_mobile_verification'); })->name('account.verify_mobile_number');
    Route::post('/verify-mobile-number', 'Account\AccountMobileController@verifyMobileNumber');
});

Route::get('/me', 'Home\HomeController@index')->name('home');
