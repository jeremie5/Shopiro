<?php
namespace Shopiro;

class Warehouse {
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'warehouses'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $warehouseId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'warehouse'], $payload=["sid" => $warehouseId]);
		return $response;
	}
	
}