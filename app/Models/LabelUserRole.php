<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 11/08/2018
 * Time: 12:08
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class LabelUserRole extends Model
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
        'label_id',
        'user_id',
        'role',
        'created_at',
        'updated_at'
    ];

    public function label()
    {
        return $this->belongsTo('App\Models\Label');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
