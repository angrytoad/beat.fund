<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 13:40
 */
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show()
    {
        return view('store.store')->with([
            'profile' => Auth::user()->profile,
            'store' => Auth::user()->store
        ]);
    }
}
