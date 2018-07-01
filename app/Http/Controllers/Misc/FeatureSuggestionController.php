<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 01/07/2018
 * Time: 18:52
 */

namespace App\Http\Controllers\Misc;


use App\Exceptions\RecaptchaException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\RecaptchaInterface;
use App\Mail\Admin\NewFeatureSuggestion;
use App\Mail\Misc\USER_NewFeatureSuggestion;
use App\Models\FeatureSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeatureSuggestionController extends Controller
{

    public $recaptchaInterface;

    public function __construct(RecaptchaInterface $recaptchaInterface)
    {
        $this->recaptchaInterface = $recaptchaInterface;
    }
    
    public function show(){
        return view('misc.suggest_a_feature')->with([
            'suggestions' => FeatureSuggestion::orderBy('created_at','DESC')->get()
        ]);
    }

    public function post(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'featured_link' => 'max:255',
            'suggestion' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required',
            'feature_acknowledgement' => 'required',
        ]);

        try{
            if(!$this->recaptchaInterface->verify($request->get('g-recaptcha-response'))){
                throw new RecaptchaException();
            }
        }catch(RecaptchaException $e){
            return back()->withErrors([
                'alert-danger' => 'We could not verify that you aren\'t a robot, you haven\'t augmented yourself recently have you?'
            ])->withInput($request->all());
        }

        Mail::to(env('ADMIN_EMAIL','support@beat.fund'))->send(new NewFeatureSuggestion($request));
        Mail::to($request->get('email'))->send(new USER_NewFeatureSuggestion($request));

        return back()->with([
            'alert-success' => 'Thanks for sending me your suggestion!'
        ]);
    }
    
}