<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 01/07/2018
 * Time: 22:17
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class FeatureSuggestion extends Model
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
        'name',
        'email',
        'featured_link',
        'suggestion',
        'created_at',
        'updated_at'
    ];
}
