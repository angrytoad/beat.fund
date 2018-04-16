<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 25/03/2018
 * Time: 00:33
 */
namespace App\Http\Controllers\Store\Products\ProductLineItems;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Library\Contracts\ProductStorageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use AWS;
use FFMpeg;

class UploadItemFileController extends Controller
{

    public $productStorageInterface;

    /**
     * UploadItemFileController constructor.
     * @param ProductStorageInterface $productStorageInterface
     */
    public function __construct(ProductStorageInterface $productStorageInterface)
    {
        $this->productStorageInterface = $productStorageInterface;
    }

    public function upload(Request $request) {
        $file = $request->file('file');

        $request->validate([
            'file.*' => 'required|mimetypes:ogg,wav,aac,mp4,mp3,m4a'
        ]);


        try{

            $file_name = $file->store('product-items',['disk' => 's3','visibility' => 'public']);
            $public_url = $this->productStorageInterface->url($file_name);

            if ($file_name) {
                if(Helper::getS3Filesize($file_name) > env('MAX_ITEM_UPLOAD_SIZE',40000)){
                    $this->productStorageInterface->delete($file_name);
                    throw(new \Exception('You are not allowed to upload files greater than '.number_format(env('MAX_ITEM_UPLOAD_SIZE',40000)/1000).'MB'));
                }

                if(Helper::getAudioBitrate($file_name) < (int)env('MINIMUM_BITRATE',128)){
                    $this->productStorageInterface->delete($file_name);
                    throw(new \Exception('This file need to have a minimum average bitrate of '.env('MINIMUM_BITRATE',128).'Kb/s'));
                }

                return response()->json([
                    'public_url' => $public_url,
                    's3_name' => $file_name,
                    'client_name' => $file->getClientOriginalName()
                ], 200);
            }

            return response()->json('error', 400);

        }catch(\Exception $e){
            return response()->json($e->getMessage(),422);
        }
    }
}
