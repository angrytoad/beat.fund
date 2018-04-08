<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Storefront\Artist\Product;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProductIsLive
{
    public function handle($request, Closure $next)
    {
        $product = Product::find($request->uuid);

        if($product && $product->live){
            return $next($request);
        }

        return abort(404);
    }
}