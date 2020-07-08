<?php

namespace App\Lib;

/**
 * This lib is for helping all necessery things for this Project
 * 
 * @author Fachrurozi <rfachru3@outlook.com>
 */
class DMlib
{
    /**
     * get data from api
     * 
     */
    public function apiGet($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        return json_decode($output);
    }

    public function getProductById($idProduct)
    {
        $productData = $this->apiGet('http://api.duniamurah.com/api/products?where[]=prod_id,=,'.$idProduct);

        return $productData->data[0];
    }

    public function getProductByName($query)
    {
        $productData = $this->apiGet('http://api.duniamurah.com/api/products?where[]=prod_name,LIKE,%' . $query . '%');
        
        return $productData->data;
    }
}
