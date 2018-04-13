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
use App\Models\StripeCustomerAccountCard;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class OwnsCard
{
    public function handle($request, Closure $next)
    {
        $card = StripeCustomerAccountCard::find($request->card_id);

        if($card && $card->stripe_customer_account->user->id === Auth::user()->id){
            return $next($request);
        }

        return abort(404);

    }
}