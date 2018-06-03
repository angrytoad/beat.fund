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

class TicketNotLive
{
    public function handle($request, Closure $next)
    {
        $ticket = Ticket::find($request->uuid);

        if($ticket && (!$ticket->live || $ticket->has_ticket_expired())){
            return $next($request);
        }

        return back()->withErrors([
            'You can\'t delete a ticket that is live and has not yet expired.'
        ]);
    }
}