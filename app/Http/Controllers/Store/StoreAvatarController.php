<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/04/2018
 * Time: 23:50
 */
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;
use AWS;

class StoreAvatarController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show(){
        return view('store.add_avatar');
    }

    public function add(Request $request){
        $request->validate([
            'image' => 'required'
        ]);

        $store = Auth::user()->store;

        try{
            $image_key = Auth::user()->id.'/stores/'.Auth::user()->store->id.'/'.$request->get('image');
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

            if($store->avatar_key !== null){
                $s3->deleteObject(array(
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $store->avatar_key
                ));
            }

            $store->avatar_url = $result->get('ObjectURL');
            $store->avatar_key = $image_key;
            $store->save();

            Storage::delete($request->get('image'),'s3');

        }catch(\Exception $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return redirect(route('store'))->with([
            'alert-success' => 'An avatar has been successfully added to your store.'
        ]);
    }

    public function upload(Request $request) {

        $request->validate([
            'file' => 'required|image'
        ]);

        $image = $request->file('file');
        $file_name = $image->store('avatars',['disk' => 's3','visibility' => 'public']);

        if ($file_name) {
            $source_file = Storage::url($file_name,'s3');
            return response()->json([
                'file_name' => $file_name,
                'source_file' => $source_file
            ], 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
}

