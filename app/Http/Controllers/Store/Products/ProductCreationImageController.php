<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 00:29
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCreationImageController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function upload(Request $request) {

        $request->validate([
           'file' => 'required|image'
        ]);
        
        $image = $request->file('file');
        $file_name = $image->store('products',['disk' => 's3','visibility' => 'public']);

        if ($file_name) {
            return response()->json($file_name, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
}
