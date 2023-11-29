<?php
namespace Shopiro;

class Transaction {
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'transactions'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $transactionId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'transaction'], $payload=["tid" => $transactionId]);
		return $response;
	}

}