<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Order extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function items(){
        return $this->hasMany('App\Models\OrderItem');
    }

    public function shortid(){
        return $this->id;
    }

    public function total(){
        $total = 0;
        foreach($this->items as $item){
            $total += $item->price_paid;
        }
        return $total;
    }
}
