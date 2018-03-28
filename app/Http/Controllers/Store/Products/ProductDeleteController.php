<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/03/2018
 * Time: 00:54
 */
namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDeleteController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show($product_uuid) {
        $product = Product::find($product_uuid);
        return view('store.products.delete')->with([
            'product' => $product
        ]);
    }

    public function delete(Request $request, $product_uuid) {

        $request->validate([
            'delete_product_checkbox' => 'required'
        ]);

        $product = Product::find($product_uuid);
        $product->delete();

        return redirect(route('store.products'))->with([
            'alert-success' => $product->name.' has been successfully removed from your store.'
        ]);
    }
}
