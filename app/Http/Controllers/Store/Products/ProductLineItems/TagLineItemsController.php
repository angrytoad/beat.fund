<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/03/2018
 * Time: 20:50
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLineItem;
use App\Models\ProductLineItemTag;
use Illuminate\Http\Request;

class TagLineItemsController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($uuid)
    {
        return view('store.products.line_item.tag')->with([
            'product' => Product::find($uuid)
        ]);
    }

    public function tag(Request $request, $uuid) {
        $request->validate([
            'tags' => 'required',
            'items' => 'required'
        ]);

        foreach ($request->get('items') as $item){
            foreach($request->get('tags') as $tag){
                $found = false;
                $item_model = ProductLineItem::find($item);
                if($item_model){
                    foreach($item_model->tags as $item_tag){
                        if($item_tag->name == $tag){
                            $found = true;
                        }
                    }
                    if(!$found){
                        $new_tag = new ProductLineItemTag();
                        $new_tag->product_line_item_id = $item_model->id;
                        $new_tag->name = $tag;
                        $new_tag->save();
                    }
                }

            }
        }

        return redirect(route('store.products.product',$uuid))->with([
            'alert-success' => 'Tags successfully updated'
        ]);
    }
}
