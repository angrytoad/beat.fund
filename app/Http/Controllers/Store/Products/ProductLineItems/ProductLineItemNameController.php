<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 31/03/2018
 * Time: 12:52
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Models\ProductLineItem;
use Illuminate\Http\Request;

class ProductLineItemNameController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function update(Request $request, $product_uuid, $item_uuid) {
        $request->validate([
           'name' => 'required|min:1'
        ]);

        $product_line_item = ProductLineItem::find($item_uuid);
        $product_line_item->name = $request->get('name');
        $product_line_item->save();

        return back()->with([
            'alert-success' => 'Product name successfully updated.'
        ]);
    }
}
