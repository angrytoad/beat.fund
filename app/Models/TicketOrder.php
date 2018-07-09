<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/03/2018
 * Time: 00:08
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketOrder extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ticket_id',
        'user_id',
        'email',
        'full_name',
        'quantity',
        'price_per_ticket',
        'total_paid',
        'seed',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    public function ticket_checkins(){
        return $this->hasMany('App\Models\TicketCheckin');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
