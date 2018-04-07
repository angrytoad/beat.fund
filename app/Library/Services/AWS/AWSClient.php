<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 13:27
 */
namespace App\Library\Services\AWS;

use AWS;

class AWSClient{

    private $client;

    public function __construct($client, array $args = []){
        $this->client = AWS::createClient($client, $args);
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

}