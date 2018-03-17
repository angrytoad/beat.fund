<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 02:30
 */
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show()
    {
        return view('profile.profile');
    }
}
