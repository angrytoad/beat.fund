<?php

namespace App\Providers;

use App\Library\Services\AWS\S3ProductStorage;
use App\Library\Services\Store\SessionCart;
use App\Library\Services\Store\Storefront;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{

    public $product;
    public $store;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
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

        $this->app->bind('App\Library\Repositories\StorefrontRepository', function(){
            return new Storefront($this->product, $this->store);
        });
    }
}
