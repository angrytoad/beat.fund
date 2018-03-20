<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Uuids;

class ProfileLink extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'profile_id', 'type', 'link'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
