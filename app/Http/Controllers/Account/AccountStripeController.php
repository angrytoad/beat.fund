<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/04/2018
 * Time: 22:58
 */
namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\StripeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class AccountStripeController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show(){
        if(Auth::user()->stripe_account){
            $stripe = Stripe::accountId(Auth::user()->stripe_account->stripe_user_id);
            return view('account.stripe.account')->with([
                'stripe_account' => $stripe->account()->details()
            ]);
        }
        return view('account.stripe.account');
    }

    public function connect(Request $request){
        if($request->has('error')){
            return redirect(route('account.stripe'))->withErrors([
                $request->get('error_description')
            ]);
        }

        try{
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => 'https://connect.stripe.com/oauth/token',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'client_secret' => env('STRIPE_SECRET'),
                    'code' => $request->get('code'),
                    'grant_type' => 'authorization_code'
                )
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $decoded_resp = json_decode($resp);

            if(property_exists($decoded_resp,'error')){
                throw new \Exception($decoded_resp->error_description);
            }

            if(Auth::user()->stripe_account){
                $stripe_account = Auth::user()->stripe_account;
                $stripe_account->stripe_user_id = $decoded_resp->stripe_user_id;
                $stripe_account->refresh_token = $decoded_resp->refresh_token;
                $stripe_account->save();
            }else{
                $stripe_account = new StripeAccount();
                $stripe_account->user_id = Auth::user()->id;
                $stripe_account->stripe_user_id = $decoded_resp->stripe_user_id;
                $stripe_account->refresh_token = $decoded_resp->refresh_token;
                $stripe_account->save();
            }

            return redirect(route('account.stripe'))->with([
                'alert-success' => 'You have successfully connected your stripe account to Beat Fund.'
            ]);

        }catch(\Exception $e){
            return redirect(route('account.stripe'))->withErrors([
                $e->getMessage()
            ]);
        }

    }
}
