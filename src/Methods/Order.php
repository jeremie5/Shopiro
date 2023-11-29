<?php
namespace Shopiro;

class Order {
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'orders'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $orderId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'order'], $payload=["oid" => $orderId]);
		return $response;
	}

}