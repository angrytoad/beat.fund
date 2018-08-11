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

class LabelUserInvite extends Model
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
        'first_name',
        'last_name',
        'email',
        'role',
        'invite_code',
        'created_at',
        'updated_at'
    ];
    
    public function label()
    {
        return $this->belongsTo('App\Models\Label');
    }
}
