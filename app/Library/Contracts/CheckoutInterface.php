<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:47
 */
namespace App\Library\Contracts;

interface CheckoutInterface {

    public function processCart($cart, $card = null, $email = null);
    
}