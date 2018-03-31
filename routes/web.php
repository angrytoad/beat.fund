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



/**
 * All routes related to action actions
 */
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

    // Homepage Once logged in
    Route::get('/', 'Home\HomeController@index')->name('home');



    /**
     * All routes for help documentation
     */
    Route::group(['prefix' => 'help'], function () {
       Route::group(['prefix' => 'store'], function () {
          Route::group(['prefix' => 'products'], function() {
              Route::get('pricing', function(){ return view('help.store.products.pricing'); })->name('help.store.products.pricing');
          });
       });
    });



    /**
     * Profile Actions
     */
    Route::group(['prefix' => 'profile'], function () {
        Route::get('create', 'Profile\ProfileCreationController@show')->name('profile.create');
        Route::post('create', 'Profile\ProfileCreationController@create');

        Route::group(['middleware' => ['user.has_profile']], function () {
            Route::get('/', 'Profile\ProfileController@show')->name('profile');
            Route::post('/', 'Profile\ProfileController@update');
        });
    });




    /**
     * Routes for store functionality
     */
    Route::group(['prefix' => 'store', 'middleware' => ['user.has_profile']], function () {



        /**
         * Routes that require the user to not have a store
         */
        Route::group(['middleware' => ['user.has_no_store']], function () {
            Route::get('create', 'Store\StoreCreationController@show')->name('store.create');
            Route::post('create', 'Store\StoreCreationController@create');
        });



        /**
         * Routes that require a store to exist
         */
        Route::group(['middleware' => ['user.has_store']], function () {

            // Show the store front
            Route::get('/', 'Store\StoreController@show')->name('store');



            /**
             * Routes for all products
             */
            Route::group(['prefix' => 'products'], function () {

                // Get all products, live and pending.
                Route::get('/', 'Store\Products\StoreProductsController@show')->name('store.products');
                Route::get('live', 'Store\Products\StoreProductsController@show_live')->name('store.products.live');
                Route::get('pending', 'Store\Products\StoreProductsController@show_pending')->name('store.products.pending');


                // Creating a product
                Route::get('create', 'Store\Products\ProductCreationController@show')->name('store.products.create');
                Route::post('create', 'Store\Products\ProductCreationController@create');
                Route::post('create/image', 'Store\Products\ProductCreationImageController@upload')->name('store.products.create.image');



                /**
                 * Routes for a specific product
                 */
                Route::group(['middleware' => ['user.has_product'], 'prefix' => '{uuid}'], function () {

                    // Get the product page AND the item page
                    Route::get('/', 'Store\Products\ProductController@show')->name('store.products.product');
                    Route::get('/rearrange-items', 'Store\Products\ProductLineItems\RearrangeLineItemsController@show')->name('store.products.product.rearrange_items');
                    Route::post('/rearrange-items', 'Store\Products\ProductLineItems\RearrangeLineItemsController@rearrange');
                    
                    Route::get('/tag-items', 'Store\Products\ProductLineItems\TagLineItemsController@show')->name('store.products.product.tag_items');
                    Route::post('/tag-items', 'Store\Products\ProductLineItems\TagLineItemsController@tag');

                    Route::group(['middleware' => ['user.store.product_not_live']], function () {

                        
                        Route::get('/delete', 'Store\Products\ProductDeleteController@show')->name('store.products.product.delete');
                        Route::post('/delete', 'Store\Products\ProductDeleteController@delete');
                        
                        // Allow items to be added and for the product to be updated
                        Route::post('/', 'Store\Products\ProductController@update');
                        Route::get('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@show')->name('store.products.product.add_items');
                        Route::post('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@upload');
                        Route::post('add-items/upload-file', 'Store\Products\ProductLineItems\UploadItemFileController@upload')->name('store.products.product.upload_file');
                    });
                    
                    /**
                     * Routes for a specific item
                     */
                    Route::group(['middleware' => ['user.store.product.has_item'], 'prefix' => 'item'], function () {
                        Route::get('{item_uuid}', 'Store\Products\ProductLineItems\ProductLineItemController@show')->name('store.products.product.item');
                        Route::post('{item_uuid}/tags/delete', 'Store\Products\ProductLineItems\ProductLineItemTags\ProductLineItemTagsDeletionController@delete')->name('store.products.product.item.tags.delete');
                        /**
                         * Routes for a specific item that requires the product to be pending
                         */
                        Route::group(['middleware' => ['user.store.product_not_live']], function () {
                            Route::get('{item_uuid}/delete', 'Store\Products\ProductLineItems\ProductLineItemDeletionController@show')->name('store.products.product.item.delete');
                            Route::post('{item_uuid}/delete', 'Store\Products\ProductLineItems\ProductLineItemDeletionController@delete');
                        });

                    });
                });
            });
        });
    });
});
