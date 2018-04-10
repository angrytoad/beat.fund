<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 01:04
 */
namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Library\Repositories\StorefrontRepository;

class StorefrontController extends Controller
{
    public $storefrontRepository;

    /**
     * StorefrontController constructor.
     * @param StorefrontRepository $storefrontRepository
     */
    public function __construct(StorefrontRepository $storefrontRepository)
    {
        $this->storefrontRepository = $storefrontRepository;
    }

    public function show(){
        return view('storefront.storefront')->with([
            'products' => $this->storefrontRepository->getAllProducts()
        ]);
    }

    public function cart(){
        return view('storefront.storefront')->with([
            'products' => $this->storefrontRepository->getAllProducts()
        ]);
    }
}
