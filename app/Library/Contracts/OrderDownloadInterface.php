<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/04/2018
 * Time: 00:42
 */
namespace App\Library\Contracts;

interface OrderDownloadInterface {
    
    public function downloadProductItems($product_items,$product);
}