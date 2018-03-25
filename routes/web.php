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

Route::get('/revenue-sharing-policy', 'Misc\RevenueSharingPolicyController@show')->name('revenue_sharing_policy');
Route::get('/store-terms-and-conditions', 'Misc\StoreTermsAndConditionsController@show')->name('store_terms_and_conditions');

Route::group(['middleware' => ['auth','email.verified'], 'prefix' => 'account'], function () {
    Route::get('/', 'Account\AccountController@show')->name('account');
    Route::get('/update-email', 'Account\AccountEmailController@show')->name('account.update_email');
    Route::post('/update-email', 'Account\AccountEmailController@postUpdate');
    Route::get('/change-password', 'Account\AccountPasswordController@show')->name('account.change_password');
    Route::post('/change-password', 'Account\AccountPasswordController@update')->name('account.update_password');
    Route::get('/add-mobile-number', 'Account\AccountMobileController@show')->name('account.add_mobile_number');
    Route::post('/add-mobile-number', 'Account\AccountMobileController@addMobileNumber');
    Route::get('/verify-mobile-number', function(){ return view('account.mobile.input_mobile_verification'); })->name('account.verify_mobile_number');
    Route::post('/verify-mobile-number', 'Account\AccountMobileController@verifyMobileNumber');
});

Route::group(['middleware' => ['auth','email.verified'], 'prefix' => 'me'], function () {
    
    Route::get('/', 'Home\HomeController@index')->name('home');
    
    Route::group(['prefix' => 'help'], function () {
       Route::group(['prefix' => 'store'], function () {
          Route::group(['prefix' => 'products'], function() {
              Route::get('pricing', function(){ return view('help.store.products.pricing'); })->name('help.store.products.pricing');
          });
       });
    });
    
    Route::group(['prefix' => 'profile'], function () {
        Route::get('create', 'Profile\ProfileCreationController@show')->name('profile.create');
        Route::post('create', 'Profile\ProfileCreationController@create');
        
        Route::group(['middleware' => ['user.has_profile']], function () {
            Route::get('/', 'Profile\ProfileController@show')->name('profile');
            Route::post('/', 'Profile\ProfileController@update');
        });
    });

    Route::group(['prefix' => 'store'], function () {
        Route::get('create', 'Store\StoreCreationController@show')->name('store.create');
        Route::post('create', 'Store\StoreCreationController@create');

        Route::group(['middleware' => ['user.has_store']], function () {
            Route::get('/', 'Store\StoreController@show')->name('store');

            Route::group(['prefix' => 'products'], function () {
                Route::get('/', 'Store\Products\StoreProductsController@show')->name('store.products');
                Route::get('live', 'Store\Products\StoreProductsController@show_live')->name('store.products.live');
                Route::get('pending', 'Store\Products\StoreProductsController@show_pending')->name('store.products.pending');
                
                Route::get('create', 'Store\Products\ProductCreationController@show')->name('store.products.create');
                Route::post('create', 'Store\Products\ProductCreationController@create');
                Route::post('create/image', 'Store\Products\ProductCreationImageController@upload')->name('store.products.create.image');

                Route::group(['middleware' => ['user.has_product'], 'prefix' => '{uuid}'], function () {
                    Route::get('/', 'Store\Products\ProductController@show')->name('store.products.product');
                    Route::get('/item/{item_uuid}', 'Store\Products\ProductLineItems\ProductLineItemController@show')->name('store.products.product.item');

                    Route::group(['middleware' => ['user.store.product_not_live']], function () {
                        Route::post('/', 'Store\Products\ProductController@update');
                        Route::get('add-items', 'Store\Products\AddLineItemsController@show')->name('store.products.product.add_items');
                        Route::post('add-items', 'Store\Products\AddLineItemsController@upload');
                        Route::post('add-items/upload-file', 'Store\Products\UploadItemFileController@upload')->name('store.products.product.upload_file');
                    });
                });
            });
        });
    });
});


