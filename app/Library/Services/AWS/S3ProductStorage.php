<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 13:13
 */

namespace App\Library\Services\AWS;


use App\Library\Contracts\ProductStorageInterface;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;

class S3ProductStorage implements ProductStorageInterface
{
    
    public $s3;
    private $bucket;

    public function __construct(array $args = []){

        $this->s3 = new AWSClient('s3', $args);
        $this->bucket = env('AWS_BUCKET');
    }

    public function setBucket($bucket){
        $this->bucket = $bucket;
    }
    
    public function store($destination_key, $source_file){
        $this->s3->client->putObject(array(
            'ACL' => 'private',
            'Bucket' => $this->bucket,
            'Key' => $destination_key,
            'Body' => new CachingStream(
                new Stream(fopen($source_file, 'r'))
            ),
        ));
    }
    
    public function delete($item_key){
        $this->s3->client->deleteObject(array(
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $item_key
        ));
    }
    
    public function url($file_name){
        return Storage::url($file_name,'s3');
    }

}