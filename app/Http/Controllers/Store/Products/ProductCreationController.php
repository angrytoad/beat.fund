<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/03/2018
 * Time: 23:44
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Product;
use AWS;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class ProductCreationController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show() {
        return view('store.products.create');
    }

    public function create(Request $request) {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'delta' => 'required',
        ]);

        $product = new Product();
        $product->id = Uuid::generate();
        $product->store_id = Auth::user()->store->id;
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->description_delta = $request->get('delta');
        $product->live = false;

        if($request->has('pricing_type')){
            $product->price = ( $request->get('price') !== null ? $request->get('price')*100 : 0 );
        }

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

                $s3->deleteObject(array(
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $request->get('image')
                ));


                $product->image_url = $result->get('ObjectURL');
                $product->image_key = $image_key;

                Storage::delete($request->get('image'),'s3');

            }catch(\Exception $e){
                return back()->withErrors([
                        $e->getMessage()
                ])->withInput();
            }
        }

        $product->save();

        $product->genres()->detach();

        foreach($request->get('genres') as $genre){
            $found_genre = Genre::find($genre);
            if($found_genre){
                $product->genres()->attach($found_genre->id);
            }
        }
        
        return redirect(route('store.products.product', $product->id))->with([
            'alert-success' => $product->name.' has been successfully created.'
        ]);
    }
}
