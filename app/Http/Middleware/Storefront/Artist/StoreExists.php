<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Storefront\Artist;

use App\Exceptions\ArtistStoreNotFoundException;
use App\Models\Store;
use Closure;

class StoreExists
{
    public function handle($request, Closure $next)
    {
        try{
            if($request->slug === null){
                throw new ArtistStoreNotFoundException();
            }
            
            if(!Store::where('slug',$request->slug)->first()){
                throw new ArtistStoreNotFoundException();
            }

            return $next($request);

        }catch(ArtistStoreNotFoundException $exception){
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