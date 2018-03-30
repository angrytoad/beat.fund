<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/03/2018
 * Time: 20:42
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLineItem;
use Illuminate\Http\Request;

class RearrangeLineItemsController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($uuid) {
        return view('store.products.line_item.rearrange')->with([
            'product' => Product::find($uuid),
            'items' => ProductLineItem::where('product_id',$uuid)->orderBy('order','ASC')->get()
        ]);
    }

    public function rearrange(Request $request, $uuid) {

        $product = Product::find($uuid);

        $request->validate([
           'items' => 'required'
        ]);

        try{
            if(count($request->get('items')) !== count($product->items)){
                throw new \Exception('There is a mismatch in the number of items you want to re-arrange and the number of items in '.$product->name.'.');
            }

            foreach($request->get('items') as $key => $item){
                $product_line_item = ProductLineItem::find($item);
                if($product_line_item->product->id !== $uuid){
                    throw new \Exception('You cannot rearrange items that do not belong to '.$product->name.'.');
                }

                $product_line_item->order = $key;
                $product_line_item->save();
            }
        }catch(\Exception $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return redirect(route('store.products.product', $uuid))->with([
            'alert-success' => 'Your line items have been successfully rearranged.'
        ]);
    }
}
