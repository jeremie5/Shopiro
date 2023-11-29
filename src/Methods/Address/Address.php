<?php
namespace Shopiro;

class Address {
	
    public static function create(string $type, array $data) {
		return \Listing\AddressFactory::create($type, $data);
    }
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'addresses'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $addressId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'address'], $payload=["aid" => $addressId]);
		return $response;
	}
	
	public static function modify(array $addressData){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'edit_address'], $payload=["act"=>"edit", "adt" => $addressData]);
		return $response;
	}
 
 	public static function set_primary(array $addressData){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'edit_address'], $payload=["act"=>"set_primary", "adt" => $addressData]);
		return $response;
	}
	
 	public static function delete(array $addressData){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'edit_address'], $payload=["act"=>"rempove", "adt" => $addressData]);
		return $response;
	}
	
}