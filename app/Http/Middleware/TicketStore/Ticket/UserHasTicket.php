<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\TicketStore\Ticket;

use App\Models\Ticket;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserHasTicket
{
    public function handle($request, Closure $next)
    {
        $ticket = Ticket::find($request->uuid);

        if($ticket && $ticket->ticket_store && $ticket->ticket_store->user->id === Auth::user()->id){
            return $next($request);
        }

        return abort(404);
    }
}