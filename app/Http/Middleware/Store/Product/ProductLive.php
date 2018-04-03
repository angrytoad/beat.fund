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

class ProductLive
{
    public function handle($request, Closure $next)
    {
        $product = Product::find($request->uuid);

        if($product && $product->live){
            return $next($request);
        }

        return back()->withErrors([
            'You cannot perform this action unless the product is live.'
        ]);
    }
}