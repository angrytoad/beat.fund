<?php

namespace App\Http;

use App\Http\Middleware\Account\Admin\IsAdmin;
use App\Http\Middleware\Account\EmailVerified;
use App\Http\Middleware\Account\OwnsCard;
use App\Http\Middleware\Profile\HasProfile;
use App\Http\Middleware\Account\HasVerification;
use App\Http\Middleware\Purchases\HasOrder;
use App\Http\Middleware\Purchases\HasOrderItem;
use App\Http\Middleware\Store\HasNoStore;
use App\Http\Middleware\Store\HasStore;
use App\Http\Middleware\Store\IsNotLive;
use App\Http\Middleware\Store\Product\LineItem\HasLineItem;
use App\Http\Middleware\Store\Product\ProductLive;
use App\Http\Middleware\Store\Product\ProductNotLive;
use App\Http\Middleware\Store\Product\UserHasProduct;
use App\Http\Middleware\Storefront\Artist\Product\ProductIsLive;
use App\Http\Middleware\Storefront\Artist\StoreExists;
use App\Http\Middleware\Storefront\HasItemsInCart;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'email.verified' => EmailVerified::class,
        'account.has_verification' => HasVerification::class,
        'user.has_profile' => HasProfile::class,
        'user.has_store' => HasStore::class,
        'user.has_no_store' => HasNoStore::class,
        'user.has_product' => UserHasProduct::class,
        'user.store.product_not_live' => ProductNotLive::class,
        'user.store.product_live' => ProductLive::class,
        'user.store.product.has_item' => HasLineItem::class,
        'store.is_not_live' => IsNotLive::class,
        'artist.store_exists' => StoreExists::class,
        'artist.product.is_live' => ProductIsLive::class,
        'is.admin' => IsAdmin::class,
        'user.owns_card' => OwnsCard::class,
        'user.has_items_in_cart' => HasItemsInCart::class,
        'purchases.has_order' => HasOrder::class,
        'purchases.has_order_item' => HasOrderItem::class
    ];
}
