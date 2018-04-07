<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06/04/2018
 * Time: 23:05
 */
namespace App\Http\Controllers\Webhooks\Stripe\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeAccountDeauthorizedController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function deauthorized(Request $request){
        dd($request);
    }
}
