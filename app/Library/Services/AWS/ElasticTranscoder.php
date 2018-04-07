<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 13:13
 */

namespace App\Library\Services\AWS;


use App\Library\Contracts\TranscodingInterface;

class ElasticTranscoder implements TranscodingInterface
{

    public $et;
    public $preset_id = '1351620000001-300040';
    public $clip = '00:00:30.000';
    public $pipeline_id = '';
    
    public function __construct(){
        
        $this->et = new AWSClient('ElasticTranscoder', array(
            'region' => env('AWS_ELASTIC_TRANSCODING_REGION')
        ));
        
        $this->pipeline_id = env('AWS_ELASTIC_TRANSCODING_PIPELINE_ID');
    }
    
    public function transcode($input_file, $output_file)
    {
        $this->et->client->createJob(array(
            'PipelineId' => env('AWS_ELASTIC_TRANSCODING_PIPELINE_ID'),
            'Input' => array(
                'Key' => $input_file,
            ),
            'Output' => array(
                'Key' => $output_file,
                'PresetId' => $this->preset_id,
                'Composition' => array(
                    array(
                        'TimeSpan' => array(
                            'Duration' => $this->clip
                        )
                    )
                )
            )
        ));
    }

}