<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Storefront\Tickets;

use App\Exceptions\ArtistStoreNotFoundException;
use App\Exceptions\TicketNotFoundException;
use App\Models\Store;
use App\Models\Ticket;
use Closure;

class TicketExists
{
    public function handle($request, Closure $next)
    {
        try{
            if($request->slug === null){
                throw new TicketNotFoundException();
            }

            if(!Ticket::where('slug',$request->slug)->first()){
                throw new TicketNotFoundException();
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
        }
    }
}