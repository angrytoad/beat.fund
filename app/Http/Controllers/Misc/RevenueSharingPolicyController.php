<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 14:00
 */
namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;

class RevenueSharingPolicyController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show()
    {
        return view('misc.revenue_sharing_policy');
    }
}
