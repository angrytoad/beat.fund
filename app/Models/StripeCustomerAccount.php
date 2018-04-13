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

class StripeCustomerAccount extends Model
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
        'user_id',
        'stripe_customer_id',
        'description',
        'default_card_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function cards(){
        return $this->hasMany('App\Models\StripeCustomerAccountCard','stripe_customer_account_id');
    }

    public function default_card(){
        return $this->hasOne('App\Models\StripeCustomerAccountCard', 'id', 'default_card_id');
    }
}