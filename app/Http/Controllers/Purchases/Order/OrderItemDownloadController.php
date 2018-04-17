<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 23:40
 */

namespace App\Http\Controllers\Purchases\Order;


use App\Http\Controllers\Controller;
use App\Library\Contracts\OrderDownloadInterface;
use App\Models\OrderItem;

class OrderItemDownloadController extends Controller
{

    public $orderDownloadInterface;

    public function __construct(OrderDownloadInterface $orderDownloadInterface)
    {
        $this->orderDownloadInterface = $orderDownloadInterface;
    }

    public function download($order_id, $order_item_id){
        $order_item = OrderItem::find($order_item_id);
        $product_items = $order_item->trashed_product->getItemsBeforeDate($order_item->created_at);
        return $this->orderDownloadInterface->downloadProductItems($product_items,$order_item->trashed_product);
    }
}