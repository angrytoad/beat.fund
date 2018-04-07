<?php

namespace App\Providers;

use App\Library\Services\AWS\ElasticTranscoder;
use Illuminate\Support\ServiceProvider;

class TranscodingServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Library\Contracts\TranscodingInterface', function(){
            return new ElasticTranscoder();
        });
    }
}
