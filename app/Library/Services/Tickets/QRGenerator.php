<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/07/2018
 * Time: 23:56
 */

namespace App\Library\Services\Tickets;


use App\Library\Contracts\TicketGenerationInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRGenerator implements TicketGenerationInterface
{

    public function generate($ticket_id, $order_id, $seed)
    {
        return base64_encode(QrCode::format('png')->size(300)->generate(route('storefront.tickets.check_in',[$ticket_id, $order_id, $seed])));
    }

}