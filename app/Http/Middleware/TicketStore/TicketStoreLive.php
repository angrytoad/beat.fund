<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\TicketStore;

use Closure;

class TicketStoreLive
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->ticket_store->live){
            return $next($request);
        }

        return redirect(route('store.tickets'))->withErrors([
            'You\'re store is currently disabled, you may not perform that action.'
        ]);
    }
}