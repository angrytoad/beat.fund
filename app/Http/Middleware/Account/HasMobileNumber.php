<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Profile;

use Closure;

class HasMobileNumber
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->mobile_number){
            return $next($request);
        }

        return redirect(route('account.add_mobile_number'))->withErrors([
            'You need to add a mobile number to your accoutn in order to perform that action.'
        ]);
    }
}