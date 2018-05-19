<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18/05/2018
 * Time: 22:58
 */

namespace App\Http\Controllers\Store\Tickets;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateTicketsImageController extends Controller
{

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|image'
        ]);

        $image = $request->file('file');
        $file_name = $image->store('ticket_banners',['disk' => 's3','visibility' => 'public']);
        $source_file = Storage::url($file_name,'s3');

        if ($file_name) {
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