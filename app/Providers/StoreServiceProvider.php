<?php

namespace App\Providers;

use App\Library\Services\AWS\S3ProductStorage;
use App\Library\Services\Store\SalesAndAnalytics\MusicStore;
use App\Library\Services\Store\SalesAndAnalytics\SalesAndAnalytics;
use App\Library\Services\Store\SessionCart;
use App\Library\Services\Store\SessionTicketCart;
use App\Library\Services\Store\Storefront;
use App\Library\Services\Store\TicketStorefront;
use App\Models\Product;
use App\Models\Store;
use App\Models\Ticket;
use App\Models\TicketStore;
use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{

    public $product;
    public $store;
    public $musicStore;
    public $ticket;
    public $ticketStore;

    /**
     * @param Product $product
     * @param Store $store
     * @param MusicStore $musicStore
     * @param Ticket $ticket
     * @param TicketStore $ticketStore
     */
    public function boot(Product $product, Store $store, MusicStore $musicStore, Ticket $ticket, TicketStore $ticketStore)
    {
        $this->product = $product;
        $this->store = $store;
        $this->musicStore = $musicStore;
        $this->ticket = $ticket;
        $this->ticketStore = $ticketStore;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Contracts\ProductStorageInterface', function(){
            return new S3ProductStorage();
        });
        
        $this->app->bind('App\Library\Contracts\CartInterface', function(){
           return new SessionCart(); 
        });

        $this->app->bind('App\Library\Contracts\TicketCartInterface', function(){
            return new SessionTicketCart();
        });

        $this->app->bind('App\Library\Repositories\StorefrontRepository', function(){
            return new Storefront($this->product, $this->store);
        });

        $this->app->bind('App\Library\Repositories\TicketStorefrontRepository', function(){
            return new TicketStorefront($this->ticket, $this->ticketStore);
        });

        $this->app->bind('App\Library\Contracts\SalesAndAnalyticsInterface', function(){
            return new SalesAndAnalytics($this->musicStore);
        });
    }
}
