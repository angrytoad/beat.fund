<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Store;

use Closure;

class HasStore
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->store){
            return $next($request);
        }

        return redirect(route('store.create'))->withErrors([
            'You need to have created a store to perform that action.'
        ]);
    }
}