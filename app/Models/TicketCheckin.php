<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/03/2018
 * Time: 00:08
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCheckin extends Model
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
        'ticket_order_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function ticket_order()
    {
        return $this->belongsTo('App\Models\Ticket');
    }
}
