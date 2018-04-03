<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/04/2018
 * Time: 21:24
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function live(Request $request, $uuid)
    {
        $product = Product::find($uuid);
        $product->live = true;
        $product->save();

        return back()->with([
            'alert-success' => $product->name.' has been set to live, it will now show whenever your store is live.'
        ]);

    }

    public function pending(Request $request, $uuid)
    {
        $product = Product::find($uuid);
        $product->live = false;
        $product->save();

        return back()->with([
            'alert-success' => $product->name.' has been set to pending, it will no longer show on your store.'
        ]);

    }
}

