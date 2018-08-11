<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 17:12
 */
namespace App\Http\Controllers\Label\Organisation\UserManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowUserManagerController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show(){
        return view('label.organisation.user_manager.index');
    }
}
