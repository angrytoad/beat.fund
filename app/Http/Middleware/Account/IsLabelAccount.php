<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 11:49
 */

namespace App\Http\Middleware\Account;

use Closure;

class IsLabelAccount
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->label){
            return $next($request);
        }

        return abort(404);
    }
}