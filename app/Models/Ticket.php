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

    public function has_ticket_expired()
    {
        $now = Carbon::now();
        return $now->diffInSeconds(Carbon::parse($this->end), false) < 0;
    }

    public function downsizedBannerImage()
    {
        return env('SERVERLESS_IMAGE_HANDLER').'/1140x250/smart/'.$this->banner_key;
    }

    public function getStaticMap()
    {
        return '
        <a target="_blank" href="https://www.google.com/maps/place/'.$this->latitude.','.$this->longitude.'/">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center='.$this->latitude.','.$this->longitude.'&zoom=13&scale=2&size=600x300&maptype=roadmap&key='.env('GOOGLE_MAPS_API_KEY').'&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0x007bff%7Clabel:%7C'.$this->latitude.','.$this->longitude.'" alt="Google Map of '.$this->name.'">
        </a>
        ';
    }
}
