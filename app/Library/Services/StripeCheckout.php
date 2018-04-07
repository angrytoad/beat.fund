<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:48
 */

namespace App\Library\Services;

use App\Library\Contracts\CheckoutInterface;

class StripeCheckout implements CheckoutInterface
{
    
    public function test(){
        dd('WORKING');
    }
    
}