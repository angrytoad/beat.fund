<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 05/04/2018
 * Time: 00:02
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class StripeAccount extends Model
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
        'stripe_user_id',
        'refresh_token'
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
