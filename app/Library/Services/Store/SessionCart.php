<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:53
 */

namespace App\Library\Services\Store;


use App\Library\Contracts\CartInterface;
use App\Models\Product;

class SessionCart implements CartInterface
{

    private $cart;
    private $formattedCart = [
        'products' => [],
        'total' => 0
    ];

    public function __construct()
    {

    }

    public function loadCart(){
        $this->cart = session()->exists('cart') ? session()->get('cart') : [];
    }

    public function productInCart($product){
        $this->loadCart();
        return array_key_exists($product->id,$this->cart);
    }

    public function saveCart(){
        session()->put('cart', $this->cart);
        session()->save();
    }
    
    public function getCart(){
        $this->loadCart();
        return $this->cart;
    }

    public function clearCart(){
        $this->cart = [];
        $this->saveCart();
    }
    
    public function addToCart($product, $price = 0)
    {
        $this->loadCart();
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
        $this->loadCart();
        if($this->productInCart($product)){
            unset($this->cart[$product->id]);
            $this->saveCart();
        }
    }

    private function addToFormattedCart($product, $price = null){
        $this->formattedCart['products'][$product->id] = [
            'product' => $product,
            'price' => $price === null ? $this->cart[$product->id]['price'] : $product->price
        ];

        $this->formattedCart['total'] += $price === null ? $this->cart[$product->id]['price'] : $product->price;
    }

    public function getFormattedCart(){
        $this->loadCart();
        foreach($this->cart as $cart_item){
            $product = Product::find($cart_item['product']['id']);
            if($product){
                if($product->price !== null){
                    $this->addToFormattedCart($product,$product->price);
                }else{
                    $this->addToFormattedCart($product);
                }
            }
        }

        return $this->formattedCart;
    }

}