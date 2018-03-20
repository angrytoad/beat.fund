<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
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
        $user = Auth::user();
        $password = $request->input('new-password');
        if (empty($user)) {
          return redirect('/');
        }
        echo $request->input('password');
        echo '<br>';
        echo $user->password;
        echo '<br>';
        echo bcrypt($request->input('password'));
die;
        if (Hash::check($request->input('password'), $user->password)) {
          return redirect()->route('account.change_password')->withErrors(['password' => 'Incorrect Password']);
        }

        $user->password = bcrypt($request->input('new-password'));
        $user->save();

        Mail::to($user->email)->send(new UpdatePasswordNotice($user));
        return redirect()->route('account.change_password')->withMsg(['success' => 'Password successfully updated!']);
    }
}
