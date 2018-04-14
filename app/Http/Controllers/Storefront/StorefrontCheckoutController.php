<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14/04/2018
 * Time: 00:48
 */

namespace App\Http\Controllers\Storefront;


use App\Exceptions\CheckoutProcessingException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\CartInterface;
use App\Library\Contracts\CheckoutInterface;
use App\Mail\Storefront\OrderCompleted;
use App\Models\StripeCustomerAccountCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\OrderItem;

class StorefrontCheckoutController extends Controller
{

    public $cartInterface;
    public $checkoutInterface;

    public function __construct(CartInterface $cartInterface, CheckoutInterface $checkoutInterface)
    {
        $this->cartInterface = $cartInterface;
        $this->checkoutInterface = $checkoutInterface;
    }
    
    public function guestCheckout(){
        return back()->with([
            'alert-warning' => 'We\'re sorry, but guest checkout is not available yet.'
        ]);

        //return view('storefront.checkout.guest');
    }

    public function userCheckout(){
        return view('storefront.checkout.user')->with([
            'cart' => $this->cartInterface->getFormattedCart()
        ]);
    }

    public function process(Request $request){
        $request->validate([
            'card' => 'required'
        ]);

        try{
            $card = StripeCustomerAccountCard::find($request->get('card'));
            if(!$card){
                throw new CheckoutProcessingException('We don\'t have that card on file.');
            }

            if($card->stripe_customer_account->user->id !== Auth::user()->id){
                throw new CheckoutProcessingException('We don\'t have that card on file.');
            }

            $cart = $this->cartInterface->getFormattedCart();
            $this->checkoutInterface->processCart($cart, $card);

            $user = Auth::user();

            $order = new Order();
            if($request->has('email')){
                $order->email = $request->get('email');
            }else{
                $order->user_id = $user->id;
                $order->email = $user->email;
            }
            $order->save();

            foreach($cart['products'] as $product_id => $product){
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product['product']->id;
                $orderItem->price_paid = $product['price'];
                $orderItem->save();
            }
            
            session()->remove('cart');

            Mail::to($order->email)->send(new OrderCompleted($order, $cart));
            return redirect(route('purchases'))->with([
                'alert-success' => 'Thanks for your order, we\'ve sent you an email to confirm your purchase'
            ]);

        }catch(CheckoutProcessingException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }
    }
    
}