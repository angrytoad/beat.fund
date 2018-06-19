<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCreationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show()
    {
        if(Auth::user()->profile){
            return redirect(route('profile'));
        }
        return view('profile.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'create_profile_checkbox' => 'required'
        ]);

        if(Auth::user()->profile){
            return redirect(route('profile'));
        }

        $profile = Profile::create([
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('store.create'))->with([
            'alert-success' => 'Your profile has been successfully set up, have fun!'
        ]);
    }
}
