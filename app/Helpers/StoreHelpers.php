<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/06/2018
 * Time: 15:49
 */

namespace App\Helpers;


use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class StoreHelpers
{

    public function getStoresCount()
    {
        return Store::where('live',true)->count();
    }

    public function getStoreProductsSampler()
    {
        $results = DB::table('products as products')
                    ->join('stores as stores', 'products.store_id', '=', 'stores.id')
                    ->select('products.*','stores.slug as store_slug')
                    ->where('products.live',true)
                    ->where('stores.live', true)
                    ->inRandomOrder()
                    ->limit(60)
                    ->get()
                    ->toArray();
        return Product::hydrate($results);
    }
    
}