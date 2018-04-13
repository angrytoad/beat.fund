<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12/04/2018
 * Time: 22:15
 */

namespace App\Library\Services\Stripe;


use Cartalyst\Stripe\Stripe;

class StripeAccountManager
{

    public $stripe;

    public function __construct()
    {
        $this->stripe = Stripe::make(env('STRIPE_SECRET'));
    }

    public function createCustomer(array $args = []){
        return $this->stripe->customers()->create($args);
        
    }

}
