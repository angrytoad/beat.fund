<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 11:49
 */

namespace App\Http\Middleware\Account;

use Closure;

class IsAdminRole
{
    public function handle($request, Closure $next)
    {
        if(
            auth()->check() &&
            (
                auth()->user()->role === 'admin'
                ||
                auth()->user()->isLabelAdmin()
            )
        ){
            return $next($request);
        }

        return back()->withErrors([
            'You do not have access to that tool'
        ]);
    }
}