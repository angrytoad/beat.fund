<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:28
 */
namespace App\Http\Controllers\Store;

use App\Exceptions\StoreSetLiveException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreSetLiveController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function live(){
        $store = Auth::user()->store;
        $profile = Auth::user()->profile;
        
        try{
            if($store === null){
                throw new StoreSetLiveException('You can\'t set a store live without a store.');
            }

            if($profile === null){
                throw new StoreSetLiveException('You can\'t set a store live without a profile.');
            }

            if($store->banner_key === null){
                throw new StoreSetLiveException('You cannot set a store live if you don\'t have a banner.');
            }

            if($store->avatar_key === null){
                throw new StoreSetLiveException('You cannot set a store live if you don\'t have an avatar.');
            }

            if(!Auth::user()->stripe_account){
                throw new StoreSetLiveException('You cannot set a store live if you haven\'t connected a stripe account.');
            }

            if($profile->getCompletionPercentage() < 100){
                throw new StoreSetLiveException('You cannot set a store live if you have no completed your profile.');
            }

            if(count($store->liveProducts()) === 0){
                throw new StoreSetLiveException('You need products before you can set your store live.');
            }

            $store->live = true;
            $store->save();

            return back()->with([
                'alert-success' => 'Your store has been successfully set live.'
            ]);

        }catch(StoreSetLiveException $exception){
            return back()->withErrors([
                $exception->getMessage()
            ]);
        }
    }
}
