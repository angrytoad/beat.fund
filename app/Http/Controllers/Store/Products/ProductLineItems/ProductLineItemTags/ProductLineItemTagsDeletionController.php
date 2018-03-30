<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 30/03/2018
 * Time: 13:39
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems\ProductLineItemTags;

use App\Http\Controllers\Controller;
use App\Models\ProductLineItemTag;
use Illuminate\Http\Request;

class ProductLineItemTagsDeletionController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function delete(Request $request, $product_uuid, $line_item_uuid){
        $request->validate([
            'tags' => 'required'
        ]);


        foreach($request->get('tags') as $tag){
            $product_line_item_tag = ProductLineItemTag::find($tag);
            if($product_line_item_tag !== null && $product_line_item_tag->product_line_item->id === $line_item_uuid){
                $product_line_item_tag->delete();
            }
        }

        return back()->with([
            'alert-success' => 'Tags successfully deleted.'
        ]);
    }
}
