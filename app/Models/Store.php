<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20/03/2018
 * Time: 00:48
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Store extends Model
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
        'live'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function getStoreName(){
        return $this->user->profile->artist_name.'\'s Store';
    }

    public function products(){
       return $this->hasMany('App\Models\Product'); 
    }

    public function liveProducts(){
        return $this->products()->where('live',true)->get();
    }

    public function pendingProducts(){
        return $this->products()->where('live',false)->get();
    }
    
    public function recentAdditions($limit){
        return $this->products()->where('live',true)->orderBy('created_at','DESC')->limit($limit)->get();
    }

    public function downsizedBanner()
    {
        return env('SERVERLESS_IMAGE_HANDLER').'/1140x330/'.$this->banner_key;
    }

    public function downsizedAvatar()
    {
        return env('SERVERLESS_IMAGE_HANDLER').'/200x200/'.$this->avatar_key;
    }
}
