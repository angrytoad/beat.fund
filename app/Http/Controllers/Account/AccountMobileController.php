<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Mail\Account\MobileNumberUpdated;
use App\Models\MobileNumberVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\Exception;
use Twilio;

class AccountMobileController extends Controller
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
        return view('account.mobile.add_mobile_number');
    }

    public function addMobileNumber(Request $request)
    {
        $request->validate([
            'country_code' => 'required',
            'mobile_number' => 'required|max:32'
        ]);
        
        $phoneString = '+'.$request->get('country_code').$request->get('mobile_number');

        if(MobileNumberVerification::where('user_id',Auth::user()->id)->first() !== null){
           MobileNumberVerification::where('user_id',Auth::user()->id)->delete();
        }

        $mobileNumberVerification = new MobileNumberVerification();
        $mobileNumberVerification->user_id = Auth::user()->id;
        $mobileNumberVerification->mobile_number = $phoneString;
        $mobileNumberVerification->token = str_random(6);
        $mobileNumberVerification->save();

        try{
            Twilio::message($phoneString, 'Here is your mobile verification token: '.$mobileNumberVerification->token);
        }catch (\Services_Twilio_RestException $e ){
            return back()->withErrors([
                'message' => $e->getMessage()
            ]);
        }

        return redirect(route('account.verify_mobile_number'));

    }

    public function verifyMobileNumber(Request $request)
    {
        $request->validate([
            'verification_code' => 'required'
        ]);

        try{
            $mobileNumberVerification = MobileNumberVerification::where('token',$request->get('verification_code'))->where('user_id',Auth::user()->id)->first();

            if($mobileNumberVerification === null){
                throw new Exception('We cannot find that token associated with your account');
            }

            $user = User::find(Auth::user()->id);
            $user->mobile_number = $mobileNumberVerification->mobile_number;
            $user->save();
            
            $mobileNumberVerification->delete();

            Mail::to($user->email)->send(new MobileNumberUpdated($user));

            return redirect(route('account'))->with([
                'alert-success' => 'You have successfully added the mobile number '.$user->mobile_number.' to this account.'
            ]);

        }catch(Exception $e){
            return back()->withErrors([
                'verification_code' => $e->getMessage()
            ]);
        }
    }
}
