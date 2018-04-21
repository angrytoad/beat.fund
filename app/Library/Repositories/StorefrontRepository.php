<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 10/04/2018
 * Time: 13:36
 */

namespace App\Library\Repositories;

interface StorefrontRepository{
    
    public function getAllProducts();
    
    public function getRecentProducts();
    
    public function searchForProducts($search);
    
}