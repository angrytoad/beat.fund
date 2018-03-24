<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 04:30
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use AWS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show($product_uuid) {
        return view('store.products.product')->with([
            'product' => Product::find($product_uuid)
        ]);
    }
    
    public function update(Request $request, $uuid) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'delta' => 'required',
        ]);
        
        $product = Product::find($uuid);
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->description_delta = $request->get('delta');
        $product->price = null;
        
        if($request->has('pricing_type')){
            $product->price = ( $request->get('price') !== null ? $request->get('price')*100 : 0 );
        }

        $product->save();

        if($request->has('image') && $request->get('image') !== null){

            try{
                $image_key = Auth::user()->id.'/stores/'.Auth::user()->store->id.'/products/'.$product->id.'/'.str_replace('products/','',$request->get('image'));
                $source_file = storage_path('app').'/'.$request->get('image');

                $s3 = AWS::createClient('s3');
                $result = $s3->putObject(array(
                    'ACL' => 'public-read',
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $image_key,
                    'SourceFile' => $source_file
                ));

                $product->image_url = $result->get('ObjectURL');
                $product->image_key = $image_key;

                Storage::delete($request->get('image'));
            }catch(\Exception $e){
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }
        }

        $product->save();

        return redirect(route('store.products.product', $product->id))->with([
            'alert-success' => 'Product successfully updated'
        ]);
    }
}
