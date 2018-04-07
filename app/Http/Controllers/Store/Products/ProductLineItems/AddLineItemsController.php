<?php

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 21:51
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Http\Controllers\Controller;
use App\Library\Contracts\ProductStorageInterface;
use App\Library\Contracts\TranscodingInterface;
use App\Models\Product;
use App\Models\ProductLineItem;
use AWS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddLineItemsController extends Controller
{

    public $transcodingInterface;
    public $productStorageInterface;


    /**
     * AddLineItemsController constructor.
     * @param TranscodingInterface $transcodingInterface
     * @param ProductStorageInterface $productStorageInterface
     */
    public function __construct(TranscodingInterface $transcodingInterface, ProductStorageInterface $productStorageInterface)
    {
        $this->transcodingInterface = $transcodingInterface;
        $this->productStorageInterface = $productStorageInterface;
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
            try{
                $product_item = new ProductLineItem();
                $product_item->product_id = $uuid;
                $product_item->name = $item['item_name'];
                $product_item->item_type = 'track';
                $product_item->order = count(Product::find($uuid)->items);

                $item_key = Auth::user()->id.'/stores/'.Auth::user()->store->id.'/products/'.$uuid.'/'.str_replace('product-items/','',$item['s3_name']);
                $item_sample_key = Auth::user()->id.'/stores/'.Auth::user()->store->id.'/products/'.$uuid.'/SAMPLE_'.str_replace('product-items/','',$item['s3_name']);

                $this->transcodingInterface->transcode($item['s3_name'],$item_sample_key);

                $source_file = $this->productStorageInterface->url($item['s3_name']);

                $this->productStorageInterface->store($item_key,$source_file);
                $this->productStorageInterface->delete($item['s3_name']);

                $product_item->item_key = $item_key;
                $product_item->item_sample_key = $item_sample_key;
            }catch(\Exception $e){
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }

            $product_item->save();

        }

        return redirect(route('store.products.product', $uuid))->with([
            'alert-success' => 'Items have been successfully added to your product.'
        ]);
    }
}
