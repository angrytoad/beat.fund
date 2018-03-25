<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/03/2018
 * Time: 00:33
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadItemFileController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function upload(Request $request) {

        $file = $request->file('file');

        $request->validate([
            'file.*' => 'required|mimetypes:ogg,wav,aac,mp4,mp3,m4a'
        ]);

        $file_name = $file->store('product-items',['disk' => 's3','visibility' => 'public']);
        $public_url = Storage::url($file_name,'s3');

        if ($file_name) {
            return response()->json([
                'public_url' => $public_url,
                's3_name' => $file_name,
                'client_name' => $file->getClientOriginalName()
            ], 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
}
