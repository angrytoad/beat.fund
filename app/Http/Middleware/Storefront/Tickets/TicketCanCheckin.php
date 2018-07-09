<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Storefront\Tickets;

use App\Exceptions\TicketNotFoundException;
use App\Exceptions\TicketOrderNotFoundException;
use App\Models\TicketOrder;
use Closure;

class TicketCanCheckin
{
    public function handle($request, Closure $next)
    {
        try{
            if($request->ticket_id === null){
                throw new TicketNotFoundException();
            }

            $ticketOrder = TicketOrder::where('ticket_id',$request->ticket_id)->where('id',$request->ticket_order_id)->where('seed',$request->seed)->first();

            if($ticketOrder === null){
                throw new TicketOrderNotFoundException();
            }

            return $next($request);

        }catch(TicketNotFoundException $exception){
            if($exception->getMessage()){
                return back()->withErrors([
                    $exception->getMessage()
                ]);
            }else{
                return abort(404);
            }
        }catch(TicketOrderNotFoundException $exception){
            if($exception->getMessage()){
                return back()->withErrors([
                    $exception->getMessage()
                ]);
            }else{
                return abort(404);
            }
        }
    }
}