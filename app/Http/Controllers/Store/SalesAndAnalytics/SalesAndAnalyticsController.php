<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/05/2018
 * Time: 23:59
 */

namespace App\Http\Controllers\Store\SalesAndAnalytics;


use App\Http\Controllers\Controller;
use App\Library\Contracts\SalesAndAnalyticsInterface;
use Illuminate\Support\Facades\Auth;

class SalesAndAnalyticsController extends Controller
{

    public $salesAndAnalyticsInterface;

    public function __construct(SalesAndAnalyticsInterface $salesAndAnalyticsInterface)
    {
        $this->salesAndAnalyticsInterface = $salesAndAnalyticsInterface;
    }


    public function show()
    {

        return view('store.sales_and_analytics.sales_and_analytics')->with([
            'user' => Auth::user(),
            'store' => Auth::user()->store,
            'music_store' => $this->salesAndAnalyticsInterface->MusicStore(Auth::user())
        ]);
    }

}