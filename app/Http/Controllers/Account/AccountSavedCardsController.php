<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12/04/2018
 * Time: 22:11
 */

namespace App\Http\Controllers\Account;


use App\Exceptions\AccountCardException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\AccountCardInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSavedCardsController extends Controller
{

    public $accountCardInterface;

    public function __construct(AccountCardInterface $accountCardInterface)
    {
        $this->accountCardInterface = $accountCardInterface;
    }

    public function show(){
        return view('account.cards.cards')->with([
            'stripeCustomerAccount' => Auth::user()->stripe_customer_account
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'stripeToken' => 'required',
            'name' => 'required',
        ]);
        
        try{
            if($request->has('make_default')){
                $this->accountCardInterface->addCard($request->get('stripeToken'), $request->get('name'), true);
            }else{
                $this->accountCardInterface->addCard($request->get('stripeToken'), $request->get('name'));
            }


            return back()->with([
                'alert-success' => 'Your card has been successfully added.'
            ]);
        }catch(AccountCardException $exception){
            return back()->withErrors([
                $exception->getMessage()
            ]);
        }
    }
}