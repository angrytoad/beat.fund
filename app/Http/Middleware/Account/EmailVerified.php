<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Account;

use App\Http\Controllers\Auth\LoginController;
use Closure;
class EmailVerified
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->email_verified){
            return $next($request);
        }

        return redirect(route('account.needs_verification'));
    }
}