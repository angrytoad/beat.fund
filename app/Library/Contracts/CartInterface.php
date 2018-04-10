<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:51
 */
namespace App\Library\Contracts;

interface CartInterface{
    
    public function addToCart($product, $price = 0);

    public function removeFromCart($product);
    
    public function saveCart();

    public function getCart();

    public function clearCart();
    
}