<?php

namespace App\Providers;

use App\Library\Services\StripeCheckout;
use App\Library\Services\Stripe\StripeTicketCheckout;
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
        
        $this->app->bind('App\Library\Contracts\TicketCheckoutInterface', function(){
            return new StripeTicketCheckout();
        });
    }
}
