<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20/03/2018
 * Time: 00:32
 */
namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;

class StoreTermsAndConditionsController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show()
    {
        return view('misc.store_terms_and_conditions');
    }
}
