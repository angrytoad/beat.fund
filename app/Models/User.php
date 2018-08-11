<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'email_verified', 'mobile_number', 'admin', 'label_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    public function email_verification()
    {
        return $this->hasOne('App\Models\EmailVerification');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function hasProfile()
    {
        return $this->profile !== null;
    }

    public function store()
    {
        return $this->hasOne('App\Models\Store');
    }
    
    public function ticket_store()
    {
        return $this->hasOne('App\Models\TicketStore');
    }

    public function stripe_account()
    {
        return $this->hasOne('App\Models\StripeAccount');
    }

    public function stripe_customer_account()
    {
        return $this->hasOne('App\Models\StripeCustomerAccount');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function label()
    {
        return $this->belongsTo('App\Models\Label');
    }

    public function role()
    {
        return $this->hasOne('App\Models\LabelUserRole');
    }

    public function isLabelAdmin()
    {
        return $this->label->administrator->id === $this->id;
    }
}
