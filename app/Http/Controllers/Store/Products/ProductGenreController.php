<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19/04/2018
 * Time: 01:33
 */

namespace App\Http\Controllers\Store\Products;


use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductGenreController extends Controller
{

    public function update(Request $request, $product_id){
        $request->validate([
            'genres' => 'required'
        ]);

        $product = Product::find($product_id);
        $product->genres()->detach();

        foreach($request->get('genres') as $genre){
            $found_genre = Genre::find($genre);
            if($found_genre){
                $product->genres()->attach($found_genre->id);
            }
        }

        return back()->with([
            'alert-success' => 'Genres have been successfully updated'
        ]);
    }

}