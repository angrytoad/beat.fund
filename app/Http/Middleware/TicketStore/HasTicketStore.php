<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\TicketStore;

use Closure;

class HasTicketStore
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->ticket_store){
            return $next($request);
        }

        return redirect(route('store.tickets'))->withErrors([
            'You need to enabled your ticket store to perform that action.'
        ]);
    }
}