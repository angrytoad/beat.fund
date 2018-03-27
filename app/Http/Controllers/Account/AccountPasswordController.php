<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Account\UpdatePasswordNotice;

class AccountPasswordController extends Controller
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
        return view('account.password.change_password');
    }

    public function update(UpdatePassword $request)
    {
        if (!Hash::check($request->get('password'), Auth::user()->getAuthPassword())) {
          return redirect()->route('account.change_password')->withErrors(['password' => 'Your current password is not correct.']);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        Mail::to($user->email)->send(new UpdatePasswordNotice($user));
        return redirect()->route('account.change_password')->with(
            ['alert-success' => 'Your password has been successfully updated.']
        );
    }
}
