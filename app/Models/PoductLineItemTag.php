<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/03/2018
 * Time: 21:32
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductLineItemTag extends Model
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
        'product_line_item_id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function product_line_item()
    {
        return $this->belongsTo('App\Models\ProductLineItem');
    }
}
