<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 04:30
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Product;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;
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
                $source_file = Storage::url($request->get('image'),'s3');

                $s3 = AWS::createClient('s3');
                $result = $s3->putObject(array(
                    'ACL' => 'public-read',
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $image_key,
                    'Body' => new CachingStream(
                        new Stream(fopen($source_file, 'r'))
                    ),
                ));

                Storage::delete($request->get('image'),'s3');
                Storage::delete($product->image_key, 's3');

                $product->image_url = $result->get('ObjectURL');
                $product->image_key = $image_key;

            }catch(\Exception $e){
                return back()->withErrors([
                    $e->getMessage()
                ])->withInput();
            }
        }
        
        
        foreach($request->get('genres') as $genre){
            $product->genres()->detach();
            $found_genre = Genre::find($genre);
            if($found_genre){
                $product->genres()->attach($found_genre->id);
            }
        }

        return redirect(route('store.products.product', $product->id))->with([
            'alert-success' => 'Product successfully updated'
        ]);
    }
}
