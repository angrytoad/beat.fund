<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 11:58
 */
namespace App\Http\Controllers\Label\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowDashboardController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show(){
        return view('label.dashboard')->with([
            'label' => Auth::user()->label
        ]);
    }
}
