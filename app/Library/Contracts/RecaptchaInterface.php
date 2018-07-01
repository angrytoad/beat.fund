<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 01/07/2018
 * Time: 20:46
 */
namespace App\Library\Contracts;

interface RecaptchaInterface{
    
    public function verify($response);
    
}