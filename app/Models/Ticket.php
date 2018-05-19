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

class Ticket extends Model
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
        'ticket_store_id',
        'name',
        'description',
        'description_delta',
        'start',
        'end',
        'price',
        'live',
        'latitude',
        'longitude',
        'location',
        'banner_key',
        'banner_url',
        'background_color',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function ticket_store()
    {
        return $this->belongsTo('App\Models\TicketStore');
    }
}
