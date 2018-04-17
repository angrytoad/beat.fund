<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Purchases;

use App\Models\OrderItem;
use Closure;

class HasOrderItem
{
    public function handle($request, Closure $next)
    {

        $order_item = OrderItem::find($request->order_item_id);

        if($order_item && $order_item->order->id === $request->order_id){
            return $next($request);
        }

        return abort(404);

    }
}