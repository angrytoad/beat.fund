<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 01/07/2018
 * Time: 20:47
 */

namespace App\Library\Services\Auth;


use App\Library\Contracts\RecaptchaInterface;
use GuzzleHttp\Client;

class Recaptcha implements RecaptchaInterface
{

    public function verify($response)
    {
        $client = new Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $response
            ]
        ]);
        $json = json_decode($res->getBody()->getContents());
        if($json->success){
            return true;
        }
        
        return false;
    }
}