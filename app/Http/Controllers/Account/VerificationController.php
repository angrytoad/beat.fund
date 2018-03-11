<?php

namespace App\Http\Controllers\Account;

use App\Mail\Account\Verify;
use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('account.has_verification');
    }

    public function showVerificationRequired()
    {
        return view('auth.verification_required');
    }

    public function getEmailVerification()
    {
        return EmailVerification::find(Auth::user()->email_verification->id);
    }

    public function resendVerification()
    {
        $email_verification = $this->getEmailVerification();
        if($email_verification){
            $email_verification->created_at = Carbon::now();
            $email_verification->save();
            Mail::to(Auth::user()->email)->send(new Verify(Auth::user()));
            return redirect(route('account.needs_verification'))->with([
                'alert-info' => 'Another verification email has been sent to '.Auth::user()->email.'. Please check your inbox.'
            ]);
        }else{
            $email_verification = new EmailVerification();
            $email_verification->user_id = Auth::user()->id;
            $email_verification->token = Uuid::generate();
            $email_verification->save();

            Mail::to(Auth::user()->email)->send(new Verify(Auth::user()));
        }

    }
    
    public function attemptVerification($token)
    {
        $email_verification = $this->getEmailVerification();
        if($email_verification->token === $token){
            if(Carbon::parse($email_verification->created_at)->addDay(7)->diffInSeconds(Carbon::now()) > 0){
                $user = User::find(Auth::user()->id);
                $user->email_verified = true;
                $user->save();
                
                $email_verification->delete();

                return redirect(route('welcome'))->with([
                    'alert-success' => 'You\'re account has been verified successfully, welcome to Beat Fund!'
                ]);
            }else{
                return redirect(route('account.needs_verification'))->with([
                    'alert-warning' => 'You\'re verification token has expired.'
                ]);
            }
        }else{
            return redirect(route('account.needs_verification'))->with([
                'alert-warning' => 'You\'re verification token is invalid.'
            ]);
        }
    }
}
