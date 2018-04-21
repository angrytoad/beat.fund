<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 01:04
 */
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Library\Contracts\CartInterface;
use App\Library\Repositories\StorefrontRepository;
use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public $storefrontRepository;
    public $cartInterface;

    /**
     * StorefrontController constructor.
     * @param StorefrontRepository $storefrontRepository
     * @param CartInterface $cartInterface
     */
    public function __construct(StorefrontRepository $storefrontRepository, CartInterface $cartInterface)
    {
        $this->storefrontRepository = $storefrontRepository;
        $this->cartInterface = $cartInterface;
    }

    public function show(){
        return view('storefront.storefront_BASIC')->with([
            'products' => $this->storefrontRepository->getAllProducts(),
            'recent_products' => $this->storefrontRepository->getRecentProducts(),
            'cart' => $this->cartInterface->getFormattedCart()
        ]);
    }

    public function random(){
        $product = Product::inRandomOrder()->first();
        return redirect(route('artist.store.product',[$product->store->slug, $product->id]));
    }

    public function cart(){
        return view('storefront.cart')->with([
            'cart' => $this->cartInterface->getFormattedCart()
        ]);
    }

    public function checkout(){
        return view('storefront.checkout.checkout')->with([
            'cart' => $this->cartInterface->getFormattedCart()
        ]);
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        return view('storefront.search_results')->with([
            'search_results' => $this->storefrontRepository->searchForProducts($request->get('search')),
            'search' => $request->get('search'),
            'cart' => $this->cartInterface->getFormattedCart()
        ]);
    }
}
