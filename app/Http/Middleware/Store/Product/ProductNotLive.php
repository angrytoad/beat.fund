<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Store\Product;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProductNotLive
{
    public function handle($request, Closure $next)
    {
        $product = Product::find($request->uuid);

        if($product && !$product->live){
            return $next($request);
        }

        return back()->withErrors([
            'You cannot edit a product while it is live, please set the product to pending before you edit it.'
        ]);
    }
}