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

$this->get('/', function () {
    return view('welcome')->with([
        'alert-success' => 'Your account has been verified',
    ]);
})->name('welcome');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

$this->get('/account/verify', 'Account\VerificationController@showVerificationRequired')->name('account.needs_verification');
$this->get('/account/verify/resend', 'Account\VerificationController@resendVerification')->name('account.resend_verification');
$this->get('/account/verify/{token}', 'Account\VerificationController@attemptVerification')->name('account.attempt_verification');

$this->get('/revenue-sharing-policy', 'Misc\RevenueSharingPolicyController@show')->name('revenue_sharing_policy');
$this->get('/store-terms-and-conditions', 'Misc\StoreTermsAndConditionsController@show')->name('store_terms_and_conditions');
$this->get('/privacy-policy', 'Misc\PrivacyPolicyController@show')->name('privacy_policy');

$this->get('/suggest-a-feature', 'Misc\FeatureSuggestionController@show')->name('suggest_a_feature');
$this->post('/suggest-a-feature', 'Misc\FeatureSuggestionController@post');

$this->get('/beatfund-for-artists', 'Misc\RegistrationPreambleController@showForArtists')->name('beatfund_for_artists');
$this->get('/beatfund-for-labels', 'Misc\RegistrationPreambleController@showForLabels')->name('beatfund_for_labels');


//$this->get('/zip-stream-test', 'Test\ZipStreamTestController@test');

/**
 * All Webhooks
 */
$this->group(['prefix' => 'webhooks'], function () {
    $this->group(['prefix' => 'stripe'], function () {
        $this->group(['prefix' => 'account'], function () {
            $this->get('/deauthorized', 'Webhooks\Stripe\Account\StripeAccountDeauthorizedController@deauthorized');
        });
    });
});


/**
 * All routes related to action actions
 */
$this->group(['middleware' => ['auth','email.verified'], 'prefix' => 'account'], function () {
    $this->get('/', 'Account\AccountController@show')->name('account');
    $this->get('/update-email', 'Account\AccountEmailController@show')->name('account.update_email');
    $this->post('/update-email', 'Account\AccountEmailController@postUpdate');
    $this->get('/change-password', 'Account\AccountPasswordController@show')->name('account.change_password');
    $this->post('/change-password', 'Account\AccountPasswordController@update')->name('account.update_password');
    $this->get('/add-mobile-number', 'Account\AccountMobileController@show')->name('account.add_mobile_number');
    $this->post('/add-mobile-number', 'Account\AccountMobileController@addMobileNumber');
    $this->get('/verify-mobile-number', function(){ return view('account.mobile.input_mobile_verification'); })->name('account.verify_mobile_number');
    $this->post('/verify-mobile-number', 'Account\AccountMobileController@verifyMobileNumber');
    $this->get('/cards', 'Account\AccountSavedCardsController@show')->name('account.cards');
    $this->post('/cards/add', 'Account\AccountSavedCardsController@add')->name('account.cards.add');

    $this->group(['middleware' => ['user.owns_card']], function () {
        $this->get('/cards/{card_id}', 'Account\AccountCardController@show')->name('account.cards.card');
        $this->post('/cards/{card_id}/update', 'Account\AccountCardController@update')->name('account.cards.card.update');
        $this->post('/cards/{card_id}/delete', 'Account\AccountCardController@delete')->name('account.cards.card.delete');
        $this->post('/cards/{card_id}/make-default', 'Account\AccountCardController@makeDefault')->name('account.cards.card.make_default');
    });

    $this->group(['middleware' => ['user.has_store']], function () {
        $this->get('/stripe', 'Account\AccountStripeController@show')->name('account.stripe');
        $this->get('/stripe/connect', 'Account\AccountStripeController@connect')->name('account.stripe.connect');
    });
});


/**
 * Admin Panel Routes
 */

$this->group(['middleware' => ['auth', 'email.verified', 'is.admin'], 'prefix' => 'admin'], function () {
    $this->get('/', 'Admin\AdminPanelController@show')->name('admin');
    $this->get('users', 'Admin\AdminUserController@users')->name('admin.users');
    $this->get('user/{id}', 'Admin\AdminUserController@user')->name('admin.user');
    $this->get('user/{id}/store', 'Admin\AdminUserController@store')->name('admin.user.store');
    $this->get('user/{id}/profile', 'Admin\AdminUserController@profile')->name('admin.user.profile');
    $this->post('user/{id}/purge', 'Admin\AdminUserController@purge')->name('admin.user.purge');

    $this->get('store', 'Admin\AdminUserController@store')->name('admin.store');

    $this->group(['prefix' => 'site-maintenance'], function() {
       $this->get('/', 'Admin\SiteMaintenance\SiteMaintenanceController@show')->name('admin.site_maintenance');
       $this->get('feature-suggestions', 'Admin\SiteMaintenance\FeatureSuggestionsController@show')->name('admin.site_maintenance.feature_suggestions');
       $this->post('feature-suggestions', 'Admin\SiteMaintenance\FeatureSuggestionsController@createSuggestion');
    });

});



/**
 * STOREFRONT ROUTES
 */
$this->group(['prefix' => 'music'], function () {
    $this->get('/','Storefront\StorefrontController@show')->name('storefront');
    $this->get('/search','Storefront\StorefrontController@search')->name('storefront.search');


    $this->get('/random','Storefront\StorefrontController@random')->name('storefront.random');
    $this->get('/cart','Storefront\StorefrontController@cart')->name('storefront.cart');

    $this->group(['middleware' => ['user.has_items_in_cart']], function () {
        $this->get('/checkout','Storefront\StorefrontController@checkout')->name('storefront.checkout');

        $this->get('/checkout/guest', 'Storefront\StorefrontCheckoutController@guestCheckout')->name('storefront.checkout.guest');
        $this->group(['middleware' => ['auth','email.verified']], function () {
            $this->get('/checkout/user', 'Storefront\StorefrontCheckoutController@userCheckout')->name('storefront.checkout.user');
            $this->post('/checkout','Storefront\StorefrontCheckoutController@process');
        });
    });

});

$this->group(['prefix' => 'artist'], function () {
    $this->group(['middleware' => ['artist.store_exists'], 'prefix' => '{slug}'], function () {
        $this->get('/','Storefront\Artist\ArtistStoreController@show')->name('artist.store');

        $this->group(['middleware' => ['artist.product.is_live'], 'prefix' => '{uuid}'], function () {
            $this->get('/','Storefront\Artist\Product\ArtistProductController@show')->name('artist.store.product');
            $this->post('/add-to-cart','Storefront\Cart\CartActionsController@addToCart')->name('artist.store.product.add_to_cart');
            $this->post('/remove-from-cart','Storefront\Cart\CartActionsController@removeFromCart')->name('artist.store.product.remove_from_cart');
        });
    });
});

$this->group(['prefix' => 'tickets'], function () {
    $this->group(['middleware' => ['storefront.tickets.ticket.ticket_can_checkin']], function () {
        $this->get('check-in/{ticket_id}/{ticket_order_id}/{seed}', 'Storefront\Tickets\CheckIn\TicketsCheckInController@checkIn')->name('storefront.tickets.check_in');
    });
    
    $this->get('/', 'Storefront\Tickets\TicketsController@show')->name('storefront.tickets');
    $this->get('/search','Storefront\Tickets\TicketsController@search')->name('storefront.tickets.search');
    $this->get('cart', 'Storefront\Tickets\TicketsCheckoutController@cart')->name('storefront.tickets.cart');
    $this->get('checkout', 'Storefront\Tickets\TicketsCheckoutController@show')->name('storefront.tickets.checkout');
    $this->post('checkout', 'Storefront\Tickets\TicketsCheckoutController@checkout');

    $this->group(['middleware' => ['storefront.tickets.ticket_exists','storefront.tickets.ticket_is_live'], 'prefix' => '{slug}'], function () {
        $this->get('/','Storefront\Tickets\Ticket\StorefrontTicketController@show')->name('storefront.tickets.ticket');
        $this->get('buy','Storefront\Tickets\Ticket\StorefrontTicketController@buy')->name('storefront.tickets.ticket.buy');
        $this->post('buy','Storefront\Tickets\Ticket\StorefrontTicketPurchaseController@confirmDetails');

        $this->post('remove-from-cart','Storefront\Tickets\TicketCartActionsController@removeFromCart')->name('storefront.tickets.ticket.remove_from_cart');
    });
});







$this->group(['middleware' => ['auth','email.verified'], 'prefix' => 'me'], function () {

    // Homepage Once logged in
    $this->get('/', 'Home\HomeController@index')->name('home');

    /**
     * All routes for help documentation
     */
    $this->group(['prefix' => 'help'], function () {
       $this->group(['prefix' => 'store'], function () {
          $this->group(['prefix' => 'products'], function() {
              $this->get('pricing', function(){ return view('help.store.products.pricing'); })->name('help.store.products.pricing');
          });
       });
    });

    /**
     * Collection
     */
    $this->group(['prefix' => 'collection'], function () {
        $this->get('/', 'Collection\CollectionController@show')->name('collection');
    });
    
    /**
     * Purchases
     */
    $this->group(['prefix' => 'purchases'], function () {
        $this->get('/', 'Purchases\PurchasesController@show')->name('purchases');

        $this->group(['middleware' => ['purchases.has_order'], 'prefix' => '{order_id}'], function () {
            $this->get('/', 'Purchases\PurchasesController@showOrder')->name('purchases.order');

            $this->group(['middleware' => ['purchases.has_order_item'], 'prefix' => '{order_item_id}'], function () {
               $this->get('/download', 'Purchases\Order\OrderItemDownloadController@download')->name('purchases.order.order_item.download'); 
            });
        });

    });

    /**
     * Profile Actions
     */
    $this->group(['prefix' => 'profile'], function () {
        $this->get('create', 'Profile\ProfileCreationController@show')->name('profile.create');
        $this->post('create', 'Profile\ProfileCreationController@create');

        $this->group(['middleware' => ['user.has_profile']], function () {
            $this->get('/', 'Profile\ProfileController@show')->name('profile');
            $this->post('/', 'Profile\ProfileController@update');
        });
    });




    /**
     * Routes for store functionality
     */
    $this->group(['prefix' => 'store', 'middleware' => ['user.has_profile']], function () {


        /**
         * Routes that require the user to not have a store
         */
        $this->group(['middleware' => ['user.has_no_store']], function () {
            $this->get('create', 'Store\StoreCreationController@show')->name('store.create');
            $this->post('create', 'Store\StoreCreationController@create');
        });



        /**
         * Routes that require a store to exist
         */
        $this->group(['middleware' => ['user.has_store']], function () {

            // Show the store front
            $this->get('/', 'Store\StoreController@show')->name('store');

            /**
             * Sales and Analytics
             */
            $this->group(['prefix' => 'sales-and-analytics'], function () {
                $this->get('/','Store\SalesAndAnalytics\SalesAndAnalyticsController@show')->name('store.sales_and_analytics');
                $this->get('music-store','Store\SalesAndAnalytics\MusicStoreController@show')->name('store.sales_and_analytics.music_store');
            });


            
            $this->get('/banner/add', 'Store\StoreBannerController@show')->name('store.banner.add');
            $this->post('/banner/add', 'Store\StoreBannerController@add');
            $this->post('/banner/add/image', 'Store\StoreBannerController@upload')->name('store.banner.add.image');

            $this->get('/avatar/add', 'Store\StoreAvatarController@show')->name('store.avatar.add');
            $this->post('/avatar/add', 'Store\StoreAvatarController@add');
            $this->post('/avatar/add/image', 'Store\StoreAvatarController@upload')->name('store.avatar.add.image');


            $this->group(['middleware' => ['store.is_not_live']], function () {
                $this->post('/set-live', 'Store\StoreSetLiveController@live')->name('store.set_live');
            });


            /**
             * Routes for all products
             */
            $this->group(['prefix' => 'music'], function () {

                // Get all products, live and pending.
                $this->get('/', 'Store\Products\StoreProductsController@show')->name('store.products');
                $this->get('live', 'Store\Products\StoreProductsController@show_live')->name('store.products.live');
                $this->get('pending', 'Store\Products\StoreProductsController@show_pending')->name('store.products.pending');


                // Creating a product
                $this->get('create', 'Store\Products\ProductCreationController@show')->name('store.products.create');
                $this->post('create', 'Store\Products\ProductCreationController@create');
                $this->post('create/image', 'Store\Products\ProductCreationImageController@upload')->name('store.products.create.image');



                /**
                 * Routes for a specific product
                 */
                $this->group(['middleware' => ['user.has_product'], 'prefix' => '{uuid}'], function () {

                    // Get the product page AND the item page
                    $this->get('/', 'Store\Products\ProductController@show')->name('store.products.product');
                    $this->get('/rearrange-items', 'Store\Products\ProductLineItems\RearrangeLineItemsController@show')->name('store.products.product.rearrange_items');
                    $this->post('/rearrange-items', 'Store\Products\ProductLineItems\RearrangeLineItemsController@rearrange');
                    
                    $this->get('/tag-items', 'Store\Products\ProductLineItems\TagLineItemsController@show')->name('store.products.product.tag_items');
                    $this->post('/tag-items', 'Store\Products\ProductLineItems\TagLineItemsController@tag');


                    /**
                     * Routes for a product that require the product to not be live.
                     */
                    $this->group(['middleware' => ['user.store.product_not_live']], function () {

                        $this->post('/live', 'Store\Products\ProductStatusController@live')->name('store.products.product.set_live');

                        
                        $this->get('/delete', 'Store\Products\ProductDeleteController@show')->name('store.products.product.delete');
                        $this->post('/delete', 'Store\Products\ProductDeleteController@delete');
                        
                        // Allow items to be added and for the product to be updated
                        $this->post('/', 'Store\Products\ProductController@update');
                        $this->get('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@show')->name('store.products.product.add_items');
                        $this->post('add-items', 'Store\Products\ProductLineItems\AddLineItemsController@upload');
                        $this->post('add-items/upload-file', 'Store\Products\ProductLineItems\UploadItemFileController@upload')->name('store.products.product.upload_file');
                        $this->post('update-genres', 'Store\Products\ProductGenreController@update')->name('store.products.product.update_genres');
                    });


                    /**
                     * Routes for a product that require the product to be live
                     */
                    $this->group(['middleware' => ['user.store.product_live']], function () {#
                        
                        $this->post('/pending', 'Store\Products\ProductStatusController@pending')->name('store.products.product.set_pending');
                    });


                    /**
                     * Routes for a specific item
                     */
                    $this->group(['middleware' => ['user.store.product.has_item'], 'prefix' => 'item'], function () {
                        $this->get('{item_uuid}', 'Store\Products\ProductLineItems\ProductLineItemController@show')->name('store.products.product.item');
                        $this->post('{item_uuid}/tags/delete', 'Store\Products\ProductLineItems\ProductLineItemTags\ProductLineItemTagsDeletionController@delete')->name('store.products.product.item.tags.delete');



                        /**
                         * Routes for a specific item that requires the product to be pending
                         */
                        $this->group(['middleware' => ['user.store.product_not_live']], function () {
                            $this->get('{item_uuid}/delete', 'Store\Products\ProductLineItems\ProductLineItemDeletionController@show')->name('store.products.product.item.delete');
                            $this->post('{item_uuid}/delete', 'Store\Products\ProductLineItems\ProductLineItemDeletionController@delete');
                            $this->post('{item_uuid}/update_name', 'Store\Products\ProductLineItems\ProductLineItemNameController@update')->name('store.products.product.item.update_name');
                        });

                    });
                });
            });

            /**
             * Routes for all ticket stuff
             */
            $this->group(['prefix' => 'tickets'], function () {
                $this->get('/', 'Store\Tickets\TicketsController@show')->name('store.tickets');
                $this->get('enable', 'Store\Tickets\TicketsController@enable')->name('store.tickets.enable');

                $this->group(['middleware' => ['user.ticket_store.has_ticket_store']], function () {

                    /**
                     * Routes for displaying different ticket views.
                     */
                    $this->get('all', 'Store\Tickets\TicketsController@all')->name('store.tickets.all');
                    $this->get('live', 'Store\Tickets\TicketsController@live')->name('store.tickets.live');
                    $this->get('pending', 'Store\Tickets\TicketsController@pending')->name('store.tickets.pending');
                    $this->get('expired', 'Store\Tickets\TicketsController@expired')->name('store.tickets.expired');

                    /**
                     * Routes for creating a ticket
                     */
                    $this->get('create', 'Store\Tickets\CreateTicketsController@show')->name('store.tickets.create');
                    $this->post('create', 'Store\Tickets\CreateTicketsController@create');
                    $this->post('create/image', 'Store\Tickets\CreateTicketsImageController@upload')->name('store.tickets.create.image');

                    $this->group(['middleware' => ['user.ticket_store.has_ticket'], 'prefix' => '{uuid}'], function () {
                        $this->get('/', 'Store\Tickets\Ticket\TicketController@show')->name('store.tickets.ticket');
                        $this->get('preview', 'Store\Tickets\Ticket\TicketPreviewController@show')->name('store.tickets.ticket.preview');

                        /**
                         * Routes for a specific item that requires the ticket to be pending
                         */
                        $this->group(['middleware' => ['user.ticket_store.ticket_not_live']], function () {
                            $this->post('/', 'Store\Tickets\Ticket\TicketController@edit')->name('store.tickets.ticket');
                            $this->post('live', 'Store\Tickets\Ticket\TicketStatusController@live')->name('store.tickets.ticket.set_live');
                            $this->post('pending', 'Store\Tickets\Ticket\TicketStatusController@pending')->name('store.tickets.ticket.set_pending');
                            $this->get('delete', 'Store\Tickets\Ticket\TicketDeleteController@show')->name('store.tickets.ticket.delete');
                            $this->post('delete', 'Store\Tickets\Ticket\TicketDeleteController@delete');
                        });
                    });
                });

            });
        });
    });
});
