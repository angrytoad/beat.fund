<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Storefront;

use Closure;

class HasItemsInCart
{
    public function handle($request, Closure $next)
    {

        if(session()->exists('cart') && count(session()->get('cart')) > 0){
            return $next($request);
        }

        return redirect(route('storefront.cart'))->withErrors([
            'You can\'t checkout without any items in your cart, silly billy!'
        ]);

    }
}