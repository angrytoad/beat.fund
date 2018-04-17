<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Purchases;

use App\Models\Order;
use Closure;
use Illuminate\Support\Facades\Auth;

class HasOrder
{
    public function handle($request, Closure $next)
    {

        $order = Order::find($request->order_id);

        if($order->user->id === Auth::user()->id){
            return $next($request);
        }

        return abort(404);

    }
}