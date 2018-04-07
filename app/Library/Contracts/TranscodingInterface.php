<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 13:13
 */
namespace App\Library\Contracts;

interface TranscodingInterface{

    public function transcode($input_file, $output_file);
    
}