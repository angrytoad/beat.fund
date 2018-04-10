<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:53
 */

namespace App\Library\Services\Store;


use App\Library\Contracts\CartInterface;

class SessionCart implements CartInterface
{

    private $cart;

    public function __construct()
    {
        $this->cart = session()->has('cart') ? session()->get('cart') : [];
    }

    public function productInCart($product){
        return array_key_exists($product->id,$this->cart);
    }

    public function saveCart(){
        session()->put('cart', $this->cart);
        session()->save();
    }
    
    public function getCart(){
        return $this->cart;
    }

    public function clearCart(){
        $this->cart = [];
        $this->saveCart();
    }
    
    public function addToCart($product, $price = 0)
    {
       if(!$this->productInCart($product)){
           $this->cart[$product->id] = [
                   'product' => $product,
                   'price' => (int) ($price*100)
               ];
           $this->saveCart();
       }
    }

    public function removeFromCart($product)
    {
        if(!$this->productInCart($product)){
            unset($this->cart[$product->id]);
            $this->saveCart();
        }
    }

}