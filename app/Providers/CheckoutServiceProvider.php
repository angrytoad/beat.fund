<?php

namespace App\Providers;

use App\Library\Services\StripeCheckout;
use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Contracts\CheckoutInterface', function(){
            return new StripeCheckout();
        });
    }
}
