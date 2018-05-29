<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/05/2018
 * Time: 12:22
 */

namespace App\Http\Controllers\Store\SalesAndAnalytics;


use App\Http\Controllers\Controller;
use App\Library\Contracts\SalesAndAnalyticsInterface;
use Illuminate\Support\Facades\Auth;

class MusicStoreController extends Controller
{

    public $salesAndAnalyticsInterface;

    public function __construct(SalesAndAnalyticsInterface $salesAndAnalyticsInterface)
    {
        $this->salesAndAnalyticsInterface = $salesAndAnalyticsInterface;
    }

    public function show(){
        return view('store.sales_and_analytics.music_store')->with([
            'user' => Auth::user(),
            'store' => Auth::user()->store,
            'music_store' => $this->salesAndAnalyticsInterface->MusicStore(Auth::user())
        ]);
    }

}