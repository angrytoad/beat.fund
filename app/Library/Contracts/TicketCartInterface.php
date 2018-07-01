<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:51
 */
namespace App\Library\Contracts;

interface TicketCartInterface{

    public function addToCart($ticket, $price = 0, $quantity = 1, $purchaser);

    public function removeFromCart($ticket);

    public function saveCart();

    public function getCart();

    public function clearCart();

    public function getFormattedCart();

}