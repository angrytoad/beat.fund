<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Mail\Account\EmailUpdated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AccountEmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('account.update_email');
    }

    public function postUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|unique:users',
            'password' => 'required'
        ]);

        if(Hash::check($request->get('password'), Auth::user()->getAuthPassword())){
            $user = User::find(Auth::user()->id);
            $user->email = $request->get('email');
            $user->save();

            Mail::to($user->email)->send(new EmailUpdated($user));

            return Redirect::back()->with([
                'alert-success' => 'Your email has been successfully changed to '.$user->email.'.'
            ]);
        }

        return Redirect::back()->withErrors([
            'password' => 'The entered password is incorrect.'
        ]);
    }
}
