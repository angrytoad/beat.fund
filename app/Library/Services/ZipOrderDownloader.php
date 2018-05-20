<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/04/2018
 * Time: 00:45
 */
namespace App\Library\Services;

use App\Library\Contracts\OrderDownloadInterface;
use AWS;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipStream;

class ZipOrderDownloader implements OrderDownloadInterface{

    public $s3;
    public $bucket;

    public function __construct()
    {
        $this->s3 = AWS::createClient('s3');
        $this->bucket = env('AWS_BUCKET');
    }

    public function downloadProductItems($product_items,$product){

        $this->s3->registerStreamWrapper();

        $s3 = $this->s3;
        $response = new StreamedResponse(function() use($product_items, $s3, $product)
        {
            $opt = array(
                'comment' => $product->name,
                'content_type' => 'application/octet-stream'
            );

            $zip = new ZipStream\ZipStream(str_slug($product->name, '_').'.zip', $opt);

            //loop keys - useful for multiple files
            foreach ($product_items as $item) {
                if(!empty($item->item_key)){
                    // Get the file name in S3 key so we can save it to the zip
                    //file using the same name.
                    preg_match('/\.[^\.]+$/i',$item->item_key,$ext);

                    $fileName = str_slug($item->name, '_').(is_array($ext[0]) ? $ext[0] : '.mp3');


                    $s3path = "s3://" . $this->bucket . "/" . $item->item_key;

                    //addFileFromStream
                    if ($streamRead = fopen($s3path, 'r')) {
                        $zip->addFileFromStream($fileName, $streamRead);
                    } else {
                        die('Could not open stream for reading');
                    }
                }else{
                    $fp = fopen(base_path().'/storage/tmp/'.$item->id.'.txt', 'w');
                    $metadata = stream_get_meta_data($fp);
                    fwrite($fp, $item->name.' has been removed from this product by a legal request, we apologise for this inconvenience, if you have any queries please don\'t hesitate to contact support@beat.fund');
                    $zip->addFileFromPath(str_slug($item->name, '_').'_REMOVED.txt', $metadata['uri']);
                    fclose($fp);
                    unlink($metadata['uri']);
                }
            }

            $zip->finish();

        });

        return $response;
    }

}