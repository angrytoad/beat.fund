<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 13/04/2018
 * Time: 09:58
 */

namespace App\Http\Controllers\Account;

use App\Exceptions\AccountCardException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\AccountCardInterface;
use App\Models\StripeCustomerAccountCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountCardController extends Controller
{

    public $accountCardInterface;

    public function __construct(AccountCardInterface $accountCardInterface)
    {
        $this->accountCardInterface = $accountCardInterface;
    }

    public function show($card_id)
    {
        return view('account.cards.card')->with([
            'card' => StripeCustomerAccountCard::find($card_id)
        ]);
    }

    public function update(Request $request, $card_id){
        $request->validate([
            'name' => 'required'
        ]);

        $card = StripeCustomerAccountCard::find($card_id);

        try{
            $card->name = $request->get('name');
            $card->save();
        }catch(AccountCardException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return back()->with([
            'alert-success' => 'Your card was successfully updated'
        ]);
    }

    public function delete(Request $request, $card_id){
        
        $card = StripeCustomerAccountCard::find($card_id);
        
        try{
            $this->accountCardInterface->deleteCard($card);
        }catch(AccountCardException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return redirect(route('account.cards'))->with([
            'alert-success' => $card->name.' was successfully deleted from your account'
        ]);
    }

    public function makeDefault(Request $request, $card_id){

        $card = StripeCustomerAccountCard::find($card_id);

        try{
            $this->accountCardInterface->makeDefaultCard($card);
        }catch(AccountCardException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return back()->with([
            'alert-success' => $card->name.' was made the default card on this account.'
        ]);
    }
}