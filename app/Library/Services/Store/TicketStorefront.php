<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 13:30
 */

namespace App\Library\Services\Store;


use App\Library\Repositories\TicketStorefrontRepository;
use App\Models\Ticket;
use App\Models\TicketStore;

class TicketStorefront implements TicketStorefrontRepository
{

    public $ticketModel;
    public $ticketStoreModel;

    public function __construct(Ticket $ticketModel, TicketStore $ticketStoreModel)
    {
        $this->ticketModel = $ticketModel;
        $this->ticketStoreModel = $ticketStoreModel;
    }


    public function getAllTickets()
    {
        return $this->ticketModel
            ->where('tickets.live', true)
            ->join('ticket_stores', 'tickets.ticket_store_id', '=', 'ticket_stores.id')
            ->join('users', 'ticket_stores.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'tickets.*',
                'ticketStores.live as ticketStore_live',
                'ticketStores.banner_url as ticketStore_banner',
                'ticketStores.avatar_url as ticketStore_avatar',
                'ticketStores.slug as ticketStore_slug',
                'profiles.artist_name',
                'profiles.artist_bio',
                'profiles.artist_website'
            )
            ->where('ticketStores.live',true)
            ->get();
    }

    public function getRecentTickets()
    {
        return $this->ticketModel
            ->where('tickets.live', true)
            ->join('ticket_stores', 'tickets.ticket_store_id', '=', 'ticket_stores.id')
            ->join('users', 'ticket_stores.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'tickets.*',
                'profiles.artist_name',
                'profiles.artist_bio',
                'profiles.artist_website'
            )
            ->orderBy('tickets.created_at','DESC')
            ->get();
    }

    public function searchForTickets($search)
    {
        return $this->ticketModel
            ->where('tickets.live', true)
            ->join('ticket_stores', 'tickets.ticket_store_id', '=', 'ticket_stores.id')
            ->join('users', 'ticket_stores.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'tickets.*',
                'profiles.artist_name',
                'profiles.artist_bio',
                'profiles.artist_website'
            )
            ->where(function ($query) use ($search) {
                $query->where('tickets.name', 'like', '%'.$search.'%')
                    ->orWhere('artist_name', 'like', '%'.$search.'%');
            })
            ->orderBy('tickets.created_at','DESC')
            ->get();
    }

}