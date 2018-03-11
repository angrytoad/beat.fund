<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/05/2017
 * Time: 21:55
 */

namespace App\Http\Middleware\Account;

use App\Mail\Account\Verify;
use App\Models\EmailVerification;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class HasVerification
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->email_verification !== null){
            return $next($request);
        }

        if(auth()->user()->email_verified){
            return redirect(route('account'))->with([
                'alert-info' => 'This account has already been verified!'
            ]);
        }


        $email_verification = new EmailVerification();
        $email_verification->user_id = Auth::user()->id;
        $email_verification->token = Uuid::generate();
        $email_verification->save();

        Mail::to(Auth::user()->email)->send(new Verify(User::find(Auth::user()->id)));

        return redirect(route('account.needs_verification'))->with([
            'alert-warning' => 'Please check your email as we have sent you another verification email.'
        ]);

    }
}