<?php
namespace Shopiro;

class ExchangeRate {
    
    public static function get() {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'exchange_rates']);
		return $response;
    }
	
}