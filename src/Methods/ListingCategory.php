<?php
namespace Shopiro;

class Order {
	
    public static function getAll(string $platformSegment, int $parentCategory, int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'listing_categories'], $payload=["ct" => $count, "of"=>$offset, "prt" => $parentCategory, "sgt"=>$platformSegment]);
		return $response;
    }
	
	public static function get(int $categoryId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'listing_category'], $payload=["cty" => $categoryId]);
		return $response;
	}
	
}