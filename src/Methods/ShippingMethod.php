<?php
namespace Shopiro;

class ShippingMethod {
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'shipping_methods'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $shippingMethodId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'shipping_method'], $payload=["sid" => $shippingMethodId]);
		return $response;
	}

}