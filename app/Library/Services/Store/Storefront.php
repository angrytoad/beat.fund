<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 13:30
 */

namespace App\Library\Services\Store;


use App\Library\Repositories\StorefrontRepository;
use App\Models\Product;
use App\Models\Store;

class Storefront implements StorefrontRepository
{

    public $productModel;
    public $storeModel;

    public function __construct(Product $productModel, Store $storeModel)
    {
        $this->productModel = $productModel;
        $this->storeModel = $storeModel;
    }

    public function getAllProducts()
    {
        return $this->productModel
            ->where('products.live', true)
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'products.*',
                'stores.live as store_live',
                'stores.banner_url as store_banner',
                'stores.avatar_url as store_avatar',
                'stores.slug as store_slug',
                'profiles.artist_name',
                'profiles.artist_bio',
                'profiles.artist_website'
            )
            ->where('stores.live',true)->get();
    }

}