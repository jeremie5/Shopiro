<?php
namespace Shopiro;

class Webhook {
    
    public static function get() {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'webhook']);
		return $response;
    }
	
    public static function set(string $webhook_url) {
		if(!is_array($listing)){
			throw new \Exception('Bad listing representation');
		}
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'webhook'], $payload=["lis" => $listing, "act"=>"set"]);
        return $response;
    }
	
    public static function delete() {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'webhook'], $payload=["act"=>"delete"]);
        return $response;
    }
	
}