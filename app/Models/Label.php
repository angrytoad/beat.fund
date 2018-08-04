<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 11:11
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Label extends Model
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
        'administrator_id',
        'company_number',
        'company_name',
        'company_address_first_line',
        'company_address_second_line',
        'company_address_postcode',
        'company_address_city',
        'company_address_county',
        'company_address_country',
        'company_telephone_number',
        'company_email_address'
    ];

    public function administrator()
    {
        return $this->hasOne('App\Models\User','id','administrator_id');
    }
}
