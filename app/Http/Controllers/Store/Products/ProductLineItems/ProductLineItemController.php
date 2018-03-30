<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/03/2018
 * Time: 03:04
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Models\ProductLineItem;

class ProductLineItemController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($product_uuid, $product_line_item_uuid)
    {
        return view('store.products.line_item.line_item')->with([
            'item' => ProductLineItem::find($product_line_item_uuid)
        ]);
    }
}
