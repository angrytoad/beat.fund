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
    return view('welcome')->with([
        'alert-success' => 'Your account has been verified',
    ]);
})->name('welcome');

Auth::routes();

Route::get('/account/verify', 'Account\VerificationController@showVerificationRequired')->name('account.needs_verification');
Route::get('/account/verify/resend', 'Account\VerificationController@resendVerification')->name('account.resend_verification');
Route::get('/account/verify/{token}', 'Account\VerificationController@attemptVerification')->name('account.attempt_verification');

Route::get('/revenue-sharing-policy', 'Misc\RevenueSharingPolicyController@show')->name('revenue_sharing_policy');
Route::get('/store-terms-and-conditions', 'Misc\StoreTermsAndConditionsController@show')->name('store_terms_and_conditions');
Route::get('/privacy-policy', 'Misc\PrivacyPolicyController@show')->name('privacy_policy');


Route::get('/zip-stream-test', 'Test\ZipStreamTestController@test');

/**
 * All Webhooks
 */
Route::group(['prefix' => 'webhooks'], function () {
    Route::group(['prefix' => 'stripe'], function () {
        Route::group(['prefix' => 'account'], function () {
            Route::get('/deauthorized', 'Webhooks\Stripe\Account\StripeAccountDeauthorizedController@deauthorized');
        });
    });
});


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
    Route::get('/cards', 'Account\AccountSavedCardsController@show')->name('account.cards');
    Route::post('/cards/add', 'Account\AccountSavedCardsController@add')->name('account.cards.add');

    Route::group(['middleware' => ['user.owns_card']], function () {
        Route::get('/cards/{card_id}', 'Account\AccountCardController@show')->name('account.cards.card');
        Route::post('/cards/{card_id}/update', 'Account\AccountCardController@update')->name('account.cards.card.update');
        Route::post('/cards/{card_id}/delete', 'Account\AccountCardController@delete')->name('account.cards.card.delete');
        Route::post('/cards/{card_id}/make-default', 'Account\AccountCardController@makeDefault')->name('account.cards.card.make_default');
    });

    Route::group(['middleware' => ['user.has_store']], function () {
        Route::get('/stripe', 'Account\AccountStripeController@show')->name('account.stripe');
        Route::get('/stripe/connect', 'Account\AccountStripeController@connect')->name('account.stripe.connect');
    });
});


/**
 * Admin Panel Routes
 */

Route::group(['middleware' => ['auth', 'email.verified', 'is.admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'Admin\AdminPanelController@show')->name('admin');
    Route::get('users', 'Admin\AdminUserController@users')->name('admin.users');
    Route::get('user/{id}', 'Admin\AdminUserController@user')->name('admin.user');
    Route::get('user/{id}/store', 'Admin\AdminUserController@store')->name('admin.user.store');
    Route::post('user/{id}/purge', 'Admin\AdminUserController@purge')->name('admin.user.purge');

    Route::get('store', 'Admin\AdminUserController@store')->name('admin.store');

});



/**
 * STOREFRONT ROUTES
 */
Route::group(['prefix' => 'store'], function () {
    Route::get('/','Storefront\StorefrontController@show')->name('storefront');
    Route::get('/search','Storefront\StorefrontController@search')->name('storefront.search');


    Route::get('/random','Storefront\StorefrontController@random')->name('storefront.random');
    Route::get('/cart','Storefront\StorefrontController@cart')->name('storefront.cart');

    Route::group(['middleware' => ['user.has_items_in_cart']], function () {
        Route::get('/checkout','Storefront\StorefrontController@checkout')->name('storefront.checkout');

        Route::get('/checkout/guest', 'Storefront\StorefrontCheckoutController@guestCheckout')->name('storefront.checkout.guest');
        Route::group(['middleware' => ['auth','email.verified']], function () {
            Route::get('/checkout/user', 'Storefront\StorefrontCheckoutController@userCheckout')->name('storefront.checkout.user');
            Route::post('/checkout','Storefront\StorefrontCheckoutController@process');
        });
    });

});

Route::group(['prefix' => 'artist'], function () {
    Route::group(['middleware' => ['artist.store_exists'], 'prefix' => '{slug}'], function () {
        Route::get('/','Storefront\Artist\ArtistStoreController@show')->name('artist.store');

        Route::group(['middleware' => ['artist.product.is_live'], 'prefix' => '{uuid}'], function () {
            Route::get('/','Storefront\Artist\Product\ArtistProductController@show')->name('artist.store.product');
            Route::post('/add-to-cart','Storefront\Cart\CartActionsController@addToCart')->name('artist.store.product.add_to_cart');
            Route::post('/remove-from-cart','Storefront\Cart\CartActionsController@removeFromCart')->name('artist.store.product.remove_from_cart');
        });
    });
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
     * Collection
     */
    Route::group(['prefix' => 'collection'], function () {
        Route::get('/', 'Collection\CollectionController@show')->name('collection');
    });
    
    /**
     * Purchases
     */
    Route::group(['prefix' => 'purchases'], function () {
        Route::get('/', 'Purchases\PurchasesController@show')->name('purchases');

        Route::group(['middleware' => ['purchases.has_order'], 'prefix' => '{order_id}'], function () {
            Route::get('/', 'Purchases\PurchasesController@showOrder')->name('purchases.order');

            Route::group(['middleware' => ['purchases.has_order_item'], 'prefix' => '{order_item_id}'], function () {
               Route::get('/download', 'Purchases\Order\OrderItemDownloadController@download')->name('purchases.order.order_item.download'); 
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
            
            Route::get('/banner/add', 'Store\StoreBannerController@show')->name('store.banner.add');
            Route::post('/banner/add', 'Store\StoreBannerController@add');
            Route::post('/banner/add/image', 'Store\StoreBannerController@upload')->name('store.banner.add.image');

            Route::get('/avatar/add', 'Store\StoreAvatarController@show')->name('store.avatar.add');
            Route::post('/avatar/add', 'Store\StoreAvatarController@add');
            Route::post('/avatar/add/image', 'Store\StoreAvatarController@upload')->name('store.avatar.add.image');


            Route::group(['middleware' => ['store.is_not_live']], function () {
                Route::post('/set-live', 'Store\StoreSetLiveController@live')->name('store.set_live');
            });


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


                    /**
                     * Routes for a product that require the product to not be live.
                     */
                    Route::group(['middleware' => ['user.store.product_not_live']], function () {

                        Route::post('/live', 'Store\Products\ProductStatusController@live')->name('store.products.product.set_live');

                        
                        Route::get('/delete', 'Store\Products\ProductDeleteController@show')->name('store.products.product.delete');
                        Route::post('/delete', 'Store\Products\ProductDeleteController@delete');
                        
                        // Allow items to be added and for the product to be updated
                        Route::post('/', 'Store\Products\ProductController@update');
                        Route::get('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@show')->name('store.products.product.add_items');
                        Route::post('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@upload');
                        Route::post('add-items/upload-file', 'Store\Products\ProductLineItems\UploadItemFileController@upload')->name('store.products.product.upload_file');
                        Route::post('update-genres', 'Store\Products\ProductGenreController@update')->name('store.products.product.update_genres');
                    });


                    /**
                     * Routes for a product that require the product to be live
                     */
                    Route::group(['middleware' => ['user.store.product_live']], function () {#
                        
                        Route::post('/pending', 'Store\Products\ProductStatusController@pending')->name('store.products.product.set_pending');
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
                            Route::post('{item_uuid}/update_name', 'Store\Products\ProductLineItems\ProductLineItemNameController@update')->name('store.products.product.item.update_name');
                        });

                    });
                });
            });

            /**
             * Routes for all ticket stuff
             */
            Route::group(['prefix' => 'tickets'], function () {
                Route::get('/', 'Store\Tickets\TicketsController@show')->name('store.tickets');

                Route::group(['middleware' => ['user.ticket_store.']], function () {

                });
                Route::get('/enable', 'Store\Tickets\TicketsController@enable')->name('store.tickets.enable');
            });
        });
    });
});
