<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:53
 */

namespace App\Library\Services\Store;

use App\Library\Contracts\TicketCartInterface;
use App\Models\Ticket;

class SessionTicketCart implements TicketCartInterface
{

    private $cart;
    private $formattedCart = [
        'tickets' => [],
        'total' => 0
    ];

    public function __construct()
    {

    }

    public function loadCart(){
        $this->cart = session()->exists('ticket_cart') ? session()->get('ticket_cart') : [];
    }

    public function ticketInCart($ticket){
        $this->loadCart();
        return array_key_exists($ticket->id,$this->cart);
    }

    public function saveCart(){
        session()->put('ticket_cart', $this->cart);
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

    public function addToCart($ticket, $price = 0, $quantity = 1, $purchaser)
    {
        $this->loadCart();
        if(!$this->ticketInCart($ticket)){
            $this->cart[$ticket->id] = [
                'ticket' => $ticket,
                'price' => (int) ($price*100),
                'quantity' => $quantity,
                'purchaser' => $purchaser
            ];
            $this->saveCart();
        }
    }

    public function removeFromCart($ticket)
    {
        $this->loadCart();
        if($this->ticketInCart($ticket)){
            unset($this->cart[$ticket->id]);
            $this->saveCart();
        }
    }

    private function addToFormattedCart($ticket, $price = null, $quantity = 1, $purchaser){
        $this->formattedCart['tickets'][$ticket->id] = [
            'ticket' => $ticket,
            'price' => $price === null ? $this->cart[$ticket->id]['price'] : $ticket->price,
            'quantity' => $quantity,
            'purchaser' => $purchaser
        ];

        $this->formattedCart['total'] += $price === null ? $this->cart[$ticket->id]['price']*$quantity : $ticket->price*$quantity;
    }

    public function getFormattedCart(){
        $this->loadCart();
        foreach($this->cart as $cart_item){
            $ticket = Ticket::find($cart_item['ticket']['id']);
            if($ticket){
                if($ticket->price !== null){
                    $this->addToFormattedCart($ticket,$ticket->price, $cart_item['quantity'], $cart_item['purchaser']);
                }else{
                    $this->addToFormattedCart($ticket, null, $cart_item['quantity'], $cart_item['purchaser']);
                }
            }
        }

        return $this->formattedCart;
    }

}