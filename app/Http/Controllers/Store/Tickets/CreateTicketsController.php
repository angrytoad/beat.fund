<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 15/05/2018
 * Time: 19:42
 */

namespace App\Http\Controllers\Store\Tickets;


use App\Http\Controllers\Controller;
use App\Library\Contracts\ProductStorageInterface;
use App\Library\Services\AWS\S3ProductStorage;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class CreateTicketsController extends Controller
{

    public $productStorageInterface;

    public function __construct(ProductStorageInterface $productStorageInterface)
    {
        $this->productStorageInterface = $productStorageInterface;
    }

    public function show(){
        return view('store.tickets.create')->with([

        ]);
    }

    public function create(Request $request){

        $request->validate([
            'name' => 'required|max:255',
            'start' => 'required',
            'end' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'required',
            'background_color' => 'required'
        ]);

        $ticket = new Ticket();
        $ticket->ticket_store_id = Auth::user()->ticket_store->id;
        $ticket->name = $request->get('name');
        $ticket->description = $request->get('description');
        $ticket->description_delta = $request->get('delta');
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

                $ticket->banner_url = $result->get('ObjectURL');
                $ticket->banner_key = $image_key;
            }catch(\Exception $e){
                $ticket->forceDelete();
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }
        }

        $ticket->save();



        return redirect(route('store.tickets.ticket', $ticket->id))->with([
            'alert-success' => $ticket->name.' has been successfully created.'
        ]);
    }

}