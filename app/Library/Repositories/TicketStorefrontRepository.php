<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 13:36
 */

namespace App\Library\Repositories;

interface TicketStorefrontRepository{

    public function getAllTickets();

    public function getRecentTickets();

    public function searchForTickets($search);

}