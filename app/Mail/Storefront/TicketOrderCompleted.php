<?php

namespace App\Mail\Storefront;

use App\Models\TicketOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketOrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketOrder;
    public $qr_encode;
    public $cart;

    /**
     * Create a new message instance.
     *
     * @param $ticketOrder
     * @param $qr_encode
     * @param $cart
     */
    public function __construct(TicketOrder $ticketOrder, $qr_encode, $cart)
    {
        $this->ticketOrder = $ticketOrder;
        $this->qr_encode = $qr_encode;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Your ticket order: '.$this->ticketOrder->ticket->name)
            ->from('no-reply@beat.fund')
            ->view('email.storefront.tickets.ticket_order_completed');
    }
}
