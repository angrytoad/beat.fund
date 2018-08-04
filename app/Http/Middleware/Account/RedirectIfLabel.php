<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 11:49
 */

namespace App\Http\Middleware\Account;

use Closure;

class RedirectIfLabel
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->label === null){
            return $next($request);
        }

        return redirect(route('label.dashboard'))->with([
            'alert-info' => 'Label accounts cannot access artist account pages.'
        ]);
    }
}