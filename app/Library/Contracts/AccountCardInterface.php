<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12/04/2018
 * Time: 22:15
 */

namespace App\Library\Contracts;

interface AccountCardInterface{
    
    public function addCard($stripeToken, $name, $default = false);
    
    public function deleteCard($card);
    
    public function makeDefaultCard($card);
    
}