<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14/05/2018
 * Time: 21:01
 */

namespace App\Http\Controllers\Store\Tickets;


use App\Http\Controllers\Controller;
use App\Models\TicketStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{

    public function __construct()
    {
        
    }
    
    public function show(){
        return view('store.tickets.tickets')->with([
            'user' => Auth::user()
        ]);
    }
    
    public function all(){

        $ticket_store = Auth::user()->ticket_store;

        return view('store.tickets.all')->with([
            'user' => Auth::user(),
            'ticket_store' => $ticket_store,
            'live_tickets' => $ticket_store->tickets()->where('live', '=', true)->where('end', '<', Carbon::now())->get(),
            'pending_tickets' => $ticket_store->tickets()->where('live', '=', false)->get(),
            'expired_tickets' => $ticket_store->tickets()->where('live', '=', true)->where('end', '>', Carbon::now())->get(),
            'tickets' => $ticket_store->tickets
        ]);
    }
    
    public function enable(){

        if(Auth::user()->ticket_store){
            return redirect(route('store.tickets'));
        }

        try{
            if(Auth::user()->mobile_number === null){
                throw new \Exception('You cannot create a ticket store until you have added a mobile number to your account.');
            }

            if(Auth::user()->profile->getCompletionPercentage() < 100){
                throw new \Exception('You cannot create a ticket store until your profile has been 100% completed.');
            }
        }catch (\Exception $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        $ticket_store = new TicketStore();
        $ticket_store->user_id = Auth::user()->id;
        $ticket_store->live = false;
        $ticket_store->save();

        return redirect(route('store.tickets'))->with([
            'alert-success' => 'Your ticket store has been set up, go nuts!'
        ]);
    }

}