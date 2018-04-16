<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 07/04/2018
 * Time: 13:57
 */
namespace App\Library\Contracts;

interface ProductStorageInterface{
    
    public function store($destination_key, $source_file, $public = false);
    
    public function delete($item_key);
    
    public function url($file_name);
}