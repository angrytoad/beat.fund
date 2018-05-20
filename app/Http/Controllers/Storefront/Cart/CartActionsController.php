<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 00:12
 */

namespace App\Http\Controllers\Storefront\Cart;


use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Library\Contracts\CartInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class CartActionsController extends Controller
{

    public $cartInterface;

    /**
     * CartActionsController constructor.
     * @param CartInterface $cartInterface
     */
    public function __construct(CartInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    }

    public function addToCart(Request $request, $slug, $product_id){
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);


        $product = Product::find($product_id);

        try{
            if(!$product){
                throw new ProductNotFoundException('Error adding product to Cart.');
            }
            
            $this->cartInterface->addToCart($product, $request->get('amount'));

        }catch(ProductNotFoundException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return back()->with([
            'alert-success' => $product->name.' has been added to your cart.'
        ]);
    }

    public function removeFromCart(Request $request, $slug, $product_id){

        $product = Product::find($product_id);

        try{
            if(!$product){
                throw new ProductNotFoundException('Error removing product from Cart.');
            }

            $this->cartInterface->removeFromCart($product);

        }catch(ProductNotFoundException $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }

        return back()->with([
            'alert-info' => $product->name.' has been removed from your cart.'
        ]);
    }
}