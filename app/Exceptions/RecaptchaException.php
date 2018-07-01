<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 00:15
 */

namespace App\Exceptions;

use Exception;

class RecaptchaException extends Exception
{

    public function __construct($message = '')
    {
        parent::__construct($message);
    }

}