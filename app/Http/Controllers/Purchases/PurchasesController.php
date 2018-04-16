<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14/04/2018
 * Time: 03:36
 */
namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show(){
        return view('purchases.purchases')->with([
            'orders' => Auth::user()->orders
        ]);
    }
}
