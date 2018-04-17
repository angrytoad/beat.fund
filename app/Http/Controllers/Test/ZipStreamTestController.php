<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 15:29
 */

namespace App\Http\Controllers\Test;


use App\Http\Controllers\Controller;
use App\Models\Product;
use AWS;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipStream;

class ZipStreamTestController extends Controller
{

    public function test(){
        //sample test file on s3

        $product = Product::find('01d27bc0-3cc5-11e8-8e1f-351dfb94369c');

        $s3keys = [];

        foreach($product->items as $item){
            $s3keys[] = $item;
        }

        $s3 = AWS::createClient('s3');
        $s3->registerStreamWrapper(); //required

        //using StreamedResponse to wrap ZipStream functionality for files on AWS s3.
        $response = new StreamedResponse(function() use($s3keys, $s3, $product)
        {

            // Define suitable options for ZipStream Archive.
            $opt = array(
                'comment' => $product->name,
                'content_type' => 'application/octet-stream'
            );

            //initialise zipstream with output zip filename and options.
            $zip = new ZipStream\ZipStream('test.zip', $opt);

            //loop keys - useful for multiple files
            foreach ($s3keys as $item) {
                // Get the file name in S3 key so we can save it to the zip
                //file using the same name.
                preg_match('/\.[^\.]+$/i',$item->item_sample_key,$ext);
                $fileName = str_slug($item->name).$ext[0];

                //concatenate s3path.
                $bucket = env('AWS_BUCKET'); //replace with your bucket name or get from parameters file.
                $s3path = "s3://" . $bucket . "/" . $item->item_sample_key;

                //addFileFromStream
                if ($streamRead = fopen($s3path, 'r')) {
                    $zip->addFileFromStream($fileName, $streamRead);
                } else {
                    die('Could not open stream for reading');
                }
            }

            $zip->finish();

        });

        return $response;
    }

}