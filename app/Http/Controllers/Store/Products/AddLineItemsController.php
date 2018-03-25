<?php

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 21:51
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLineItem;
use AWS;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddLineItemsController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($uuid) {
        return view('store.products.add_items')->with([
            'product' => Product::find($uuid),
        ]);
    }

    public function upload(Request $request, $uuid) {



        $request->validate([
            'items.*.s3_name' => 'required',
            'items.*.client_name' => 'required',
            'items.*.public_url' => 'required',
            'items.*.item_name' => 'required',
        ]);


        foreach($request->get('items') as $item){
            $product_item = new ProductLineItem();
            $product_item->product_id = $uuid;
            $product_item->name = $item['item_name'];
            $product_item->item_type = 'track';

            $item_key = Auth::user()->id.'/stores/'.Auth::user()->store->id.'/products/'.$uuid.'/'.str_replace('product-items/','',$item['s3_name']);
            $source_file = Storage::url($item['s3_name'],'s3');

            try{
                $s3 = AWS::createClient('s3');
                $s3->putObject(array(
                    'ACL' => 'private',
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $item_key,
                    'Body' => new CachingStream(
                        new Stream(fopen($source_file, 'r'))
                    ),
                ));

                $product_item->item_key = $item_key;
                $product_item->item_sample_key = $item_key;

                Storage::delete($item['s3_name'],'s3');
            }catch(\Exception $e){
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }

            $product_item->save();

        }

        return redirect(route('store.products.product', $uuid))->with([
            'Items have been successfully added to your product.'
        ]);
    }
}
