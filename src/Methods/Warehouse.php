<?php
namespace Shopiro;

class Warehouse {
	
    private $shopiroClient;

    public function __construct(ShopiroClient $shopiroClient) {
        $this->shopiroClient = $shopiroClient;
    }
	
    public static function getAll(int $count, int $offset) {
        $response = $this->shopiroClient->createRequest($endpoint=['get', 'warehouses'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $warehouseId){
        $response = $this->shopiroClient->createRequest($endpoint=['get', 'warehouse'], $payload=["sid" => $warehouseId]);
		return $response;
	}
	
}