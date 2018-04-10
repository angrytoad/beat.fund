<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;

class Profile extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'artist_name', 'artist_bio', 'business_email', 'favourite_genre',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function profile_links()
    {
        return $this->hasMany('App\Models\ProfileLink');
    }

    public function products()
    {
        return $this->user->store->products();
    }

    public function getCompletionPercentage()
    {
        $completion_percentage = 0;

        if($this->artist_name !== null){
            $completion_percentage += 20;
        }

        if($this->artist_bio !== null){
            $completion_percentage += 20;
        }

        if($this->business_email !== null){
            $completion_percentage += 20;
        }

        if($this->favourite_genre !== null){
            $completion_percentage += 20;
        }

        if($this->artist_website !== null){
            $completion_percentage += 20;
        }

        return $completion_percentage;
    }

    public function plaintextBio(){
        return strip_tags($this->artist_bio);
    }
}
