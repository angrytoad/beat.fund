<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12/04/2018
 * Time: 20:30
 */

namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class StripeCustomerAccountCard extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'stripe_customer_account_id',
        'name',
        'last4',
        'brand',
        'exp_month',
        'exp_year'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function stripe_customer_account(){
        return $this->belongsTo('App\Models\StripeCustomerAccount');
    }

    public function isDefaultCard(){
        return $this->stripe_customer_account->default_card_id === $this->card_token;
    }
}