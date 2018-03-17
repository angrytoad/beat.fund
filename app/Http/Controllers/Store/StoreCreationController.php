<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 13:31
 */
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;

class StoreCreationController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show()
    {
        return view('store.create');
    }
}
