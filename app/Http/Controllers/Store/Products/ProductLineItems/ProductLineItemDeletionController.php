<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27/03/2018
 * Time: 21:15
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Models\ProductLineItem;

class ProductLineItemDeletionController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show($product_uuid, $item_uuid) {
        $line_item = ProductLineItem::find($item_uuid);
        return view('store.products.line_item.delete')->with([
            'line_item' => $line_item
        ]);
    }
}

