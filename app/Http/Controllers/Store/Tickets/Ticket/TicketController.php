<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19/05/2018
 * Time: 01:03
 */

namespace App\Http\Controllers\Store\Tickets\Ticket;


use App\Http\Controllers\Controller;
use App\Library\Contracts\ProductStorageInterface;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{

    public $productStorageInterface;

    public function __construct(ProductStorageInterface $productStorageInterface)
    {
        $this->productStorageInterface = $productStorageInterface;
    }

    public function show($uuid)
    {
        $ticket = Ticket::find($uuid);
        return view('store.tickets.ticket.ticket')->with([
            'ticket' => $ticket
        ]);
    }

    public function edit(Request $request, $ticket_id){

        $request->validate([
            'name' => 'required|max:255',
            'start' => 'required',
            'end' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'required',
            'background_color' => 'required'
        ]);

        $ticket = Ticket::find($ticket_id);

        /**
         * Check if the ticket name is different and if it is, create a new slug for it.
         */
        if($request->get('name') !== $ticket->name){
            $count = Ticket::select('tickets.*')
                ->join('ticket_stores','ticket_stores.id', '=', 'tickets.ticket_store_id')
                ->join('stores', 'stores.user_id', '=', 'ticket_stores.user_id')
                ->where('tickets.slug',str_slug($request->get('name'),'-'))
                ->count();

            if($count > 0){
                $slug = str_slug($request->get('name').'-'.$count,'-');
            }else{
                $slug = str_slug($request->get('name'),'-');
            }

            $ticket->slug = $slug;
        }

        $ticket->ticket_store_id = Auth::user()->ticket_store->id;
        $ticket->name = $request->get('name');
        $ticket->description = $request->get('description');
        $ticket->description_delta = $request->get('description_delta');
        $ticket->start = Carbon::parse($request->get('start'));
        $ticket->end = Carbon::parse($request->get('end'));
        $ticket->live = false;
        $ticket->latitude = $request->get('latitude');
        $ticket->longitude = $request->get('longitude');
        $ticket->location = $request->get('location');
        $ticket->background_color = $request->get('background_color');



        $ticket->save();

        if($request->has('pricing_type')){
            $ticket->price = ( $request->get('price') !== null ? $request->get('price')*100 : 0 );
        }

        if($request->has('image') && $request->get('image') !== null){
            try{
                $image_key = Auth::user()->id.'/ticket_stores/'.Auth::user()->ticket_store->id.'/tickets/'.$ticket->id.'/'.str_replace('ticket_banners/','',$request->get('image'));
                $source_file = Storage::url($request->get('image'),'s3');

                $result = $this->productStorageInterface->store($image_key, $source_file, true);
                $this->productStorageInterface->delete($request->get('image'));

                if($ticket->banner_key !== null){
                    $this->productStorageInterface->delete($ticket->banner_key);
                }

                $ticket->banner_url = $result->get('ObjectURL');
                $ticket->banner_key = $image_key;
            }catch(\Exception $e){
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }
        }

        if($ticket->banner_key !== null && $request->has('image') && $request->get('image') === null){
            $this->productStorageInterface->delete($ticket->banner_key);
            $ticket->banner_url = null;
            $ticket->banner_key = null;
        }

        $ticket->save();



        return redirect(route('store.tickets.ticket', $ticket->id))->with([
            'alert-success' => $ticket->name.' has been successfully created.'
        ]);
    }

}