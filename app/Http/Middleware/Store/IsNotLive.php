<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Store;

use Closure;

class IsNotLive
{
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->store->live){
            return $next($request);
        }

        return back()->withErrors([
            'You cannot perform that action whilst your store is live.'
        ]);
    }
}