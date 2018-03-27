<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Profile;

use Closure;

class HasProfile
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->profile){
            return $next($request);
        }

        return redirect(route('profile.create'))->withErros(['You need to have created a profile to perform that action.']);
    }
}
