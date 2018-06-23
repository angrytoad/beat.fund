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

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

    public function plaintextDescription(){
        return strip_tags($this->description);
    }
    
    public function downsizedImage()
    {
        return env('SERVERLESS_IMAGE_HANDLER').'/300x300/'.$this->image_key;
    }

    public function getItemsBeforeDate($date){
        return $this->items()
            ->withTrashed()
            ->where('created_at','<',$date)
            ->where('deleted_at',null)
            ->orWhere('deleted_at','>',$date)
            ->where('product_id',$this->id)
            ->get();
    }
}
