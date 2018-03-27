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

class Product extends Model
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
        'store_id',
        'name',
        'description',
        'image',
        'price',
        'live',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function items()
    {
        return $this->hasMany('App\Models\ProductLineItem');
    }
}
