<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/07/2018
 * Time: 23:53
 */
namespace App\Library\Contracts;

interface TicketGenerationInterface{
    public function generate($ticket_id, $order_id, $seed);
}