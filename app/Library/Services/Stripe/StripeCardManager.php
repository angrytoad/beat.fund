<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12/04/2018
 * Time: 22:15
 */

namespace App\Library\Services\Stripe;

use App\Exceptions\AccountCardException;
use App\Library\Contracts\AccountCardInterface;
use App\Models\StripeCustomerAccount;
use App\Models\StripeCustomerAccountCard;
use Cartalyst\Stripe\Exception\StripeException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class StripeCardManager implements AccountCardInterface
{

    public $user;
    public $stripe;
    public $stripeAccountManager;

    /**
     * StripeCardManager constructor.
     * @param StripeAccountManager $stripeAccountManager
     */
    public function __construct(StripeAccountManager $stripeAccountManager)
    {

        $this->stripe = Stripe::make(env('STRIPE_SECRET'));
        $this->stripeAccountManager = $stripeAccountManager;
    }

    public function deleteCard($card){
        try{
            $this->stripe->cards()->delete($card->stripe_customer_account->stripe_customer_id, $card->card_token);

            if($card->isDefaultCard()){
                $card->stripe_customer_account->default_card_id = null;
                $card->stripe_customer_account->save();
            }

            $card->delete();

        }catch(StripeException $e){
            throw new AccountCardException($e->getMessage());
        }
    }
    
    public function makeDefaultCard($card){
        try{

            $customer = $this->stripe->customers()->update($card->stripe_customer_account->stripe_customer_id, [
                'default_source' => $card->card_token,
            ]);

            if(!$card->isDefaultCard()){
                $card->stripe_customer_account->default_card_id = $customer['default_source'];
                $card->stripe_customer_account->save();
            }

        }catch(StripeException $e){
            throw new AccountCardException($e->getMessage());
        } 
    }

    public function addCard($stripeToken, $name, $makeDefault = false){
        $this->user = Auth::user();

        if($this->user->stripe_customer_account){
            try{
                $card = $this->stripe->cards()->create($this->user->stripe_customer_account->stripe_customer_id, $stripeToken);

                $stripeCustomerAccountCard = new StripeCustomerAccountCard();
                $stripeCustomerAccountCard->stripe_customer_account_id = $this->user->stripe_customer_account->id;
                $stripeCustomerAccountCard->card_token = $card['id'];
                $stripeCustomerAccountCard->name = $name;
                $stripeCustomerAccountCard->last4 = $card['last4'];
                $stripeCustomerAccountCard->brand = $card['brand'];
                $stripeCustomerAccountCard->exp_month = $card['exp_month'];
                $stripeCustomerAccountCard->exp_year = $card['exp_year'];
                $stripeCustomerAccountCard->save();

                if($makeDefault){
                    $this->user->stripe_customer_account->default_card_id = $card['id'];
                    $this->user->stripe_customer_account->save();
                }
            }catch(StripeException $e){
                throw new AccountCardException($e->getMessage());
            }
        }else{
            try{
                $customer = $this->stripeAccountManager->createCustomer([
                    'description' => 'Customer for '.$this->user->email,
                    'email' => $this->user->email,
                    'source' => $stripeToken
                ]);

                $stripeCustomerAccount = new StripeCustomerAccount();
                $stripeCustomerAccount->user_id = $this->user->id;
                $stripeCustomerAccount->stripe_customer_id = $customer['id'];
                $stripeCustomerAccount->description = $customer['description'];
                $stripeCustomerAccount->email = $customer['email'];

                $cards = $this->stripe->cards()->all($customer['id']);
                $card = $cards['data'][0];

                $stripeCustomerAccount->default_card_id = $card['id'];
                $stripeCustomerAccount->save();

                $stripeCustomerAccountCard = new StripeCustomerAccountCard();
                $stripeCustomerAccountCard->stripe_customer_account_id = $stripeCustomerAccount->id;
                $stripeCustomerAccountCard->card_token = $card['id'];
                $stripeCustomerAccountCard->name = $name;
                $stripeCustomerAccountCard->last4 = $card['last4'];
                $stripeCustomerAccountCard->brand = $card['brand'];
                $stripeCustomerAccountCard->exp_month = $card['exp_month'];
                $stripeCustomerAccountCard->exp_year = $card['exp_year'];
                $stripeCustomerAccountCard->save();


            }catch(StripeException $e){
                throw new AccountCardException($e->getMessage());
            }

        }
    }
}
