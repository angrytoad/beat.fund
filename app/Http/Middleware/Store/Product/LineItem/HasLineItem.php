<?php

namespace App\Http\Middleware\Store\Product\LineItem;

use App\Models\ProductLineItem;
use Closure;
use Illuminate\Support\Facades\Auth;

class HasLineItem
{
    public function handle($request, Closure $next)
    {
        $line_item = ProductLineItem::find($request->item_uuid);

        if($line_item && $line_item->product->store->user->id === Auth::user()->id){
            return $next($request);
        }

        return abort(404);
    }
}