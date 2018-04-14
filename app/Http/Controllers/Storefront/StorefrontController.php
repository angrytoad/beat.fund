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
        return view('storefront.storefront')->with([
            'products' => $this->storefrontRepository->getAllProducts()
        ]);
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
}
