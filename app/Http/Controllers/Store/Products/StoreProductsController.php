<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22/03/2018
 * Time: 23:52
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreProductsController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show()
    {
        return view('store.products.products')->with([
            'live_products_count' => Auth::user()->store->products()->where('live',true)->get()->count(),
            'pending_products_count' => Auth::user()->store->products()->where('live',false)->get()->count(),
            'recent_products' => Auth::user()->store->products()->orderBy('created_at','DESC')->get(),
        ]);
    }

    public function show_live()
    {

    }

    public function show_pending()
    {
        
    }
}
