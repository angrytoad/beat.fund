<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/05/2018
 * Time: 00:37
 */

namespace App\Library\Services\Store\SalesAndAnalytics;

use App\Library\Contracts\SalesAndAnalyticsInterface;

class SalesAndAnalytics implements SalesAndAnalyticsInterface{
    
    public $musicStore;
    
    public function __construct(MusicStore $musicStore)
    {
        $this->musicStore = $musicStore;
    }

    public function MusicStore($user)
    {
        return $this->musicStore->load($user);
    }

}