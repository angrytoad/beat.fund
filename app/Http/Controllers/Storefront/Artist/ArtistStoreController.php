<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 00:48
 */

namespace App\Http\Controllers\Storefront\Artist;


use App\Http\Controllers\Controller;
use App\Models\Store;

class ArtistStoreController extends Controller
{

    public function show($slug){
        $store = Store::where('slug',$slug)->first();
        
        return view('storefront.artist.store')->with([
            'store' => $store,
            'artist' => $store->user->profile,
            'products' => $store->products
        ]);
    }
}