<?php

namespace App\Providers;

use App\Library\Services\Tickets\QRGenerator;
use App\Library\Services\ZipOrderDownloader;
use Illuminate\Support\ServiceProvider;

class PurchasesServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Library\Contracts\OrderDownloadInterface', function(){
            return new ZipOrderDownloader();
        });
        
        $this->app->bind('App\Library\Contracts\TicketGenerationInterface', function(){
           return new QRGenerator();
        });
    }
}
