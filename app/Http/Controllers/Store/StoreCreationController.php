<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 13:31
 */
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCreationController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show()
    {
        return view('store.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'create_store_checkbox' => 'required'
        ]);

        if(Auth::user()->store){
            return redirect(route('store'));
        }

        try{
            if(Auth::user()->mobile_number === null){
                throw new \Exception('You cannot create a store until you have added a mobile number to your account.');
            }

            if(Auth::user()->profile->getCompletionPercentage() < 100){
                throw new \Exception('You cannot create a store until your profile has been 100% completed.');
            }
        }catch (\Exception $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        $store = new Store();
        $store->user_id = Auth::user()->id;
        $store->live = false;
        $store->save();

        return redirect(route('store'))->with([
            'alert-success' => 'Your store has been set up, you may now start adding products.'
        ]);

    }
}
