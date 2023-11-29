<?php
namespace Shopiro;

class Listing {
    
    public static function create(string $type, array $data) {
		return \Listing\ListingFactory::create($type, $data);
    }
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'listings'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(string|array $slid){
		if(is_array($slid)){
			return self::getMany($slid);
		}
		return self::getSingle($slid);
	}
	
    public static function getSingle(string $slid) {
		if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
			throw new \Exception('SLID failed validation');
		}
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'listing'], $payload=["slid" => $slid]);
		return new BaseListingObject((array)$response);
    }
	
    public static function getMany(array $slids) {
        $result = [];
        foreach ($slids as $slid) {
			if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
				throw new \Exception('SLID failed validation');
			}
            \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'listing'], $payload=["slid" => $slid], $queue='q', $callback=function($response) use (&$result, $slid) {
                $result[$slid] = new BaseListingObject((array)$response);
            });
        }
        return $result;
    }
	
	public static function modify(array $listing){
		if(is_array($listing)){
			return self::modifyMany($listing);
		}
		return self::modifySingle($listing);
	}
	
    public static function modifySingle(array $listing) {
		if(!is_array($listing)){
			throw new \Exception('Bad listing representation');
		}
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'listing'], $payload=["lis" => $listing, "act"=>"modify"]);
        return $response;
    }
	
    public static function modifyMany(array $listings) {
        $responses = [];
        foreach ($listings as $listing) {
			if(!is_array($listing)){
				throw new \Exception('Bad listing representation');
			}
            \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'listing'], $payload=["lis" => $listing, "act"=>"modify"], $queue='q', $callback=function($response) use (&$responses, $listing) {
                $responses[$listing['slid']] = $response;
            });
        }
		\Shopiro\ShopiroClient::executeQueue($queue);
        return $responses;
    }
	
	public static function delete(string|array $listing){
		if(is_array($listing)){
			return self::deleteMany($listing);
		}
		return self::deleteSingle($listing);
	}
	
    public static function deleteSingle(string $listing) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'listing'], $payload=["slid" => $listing, "act"=>"delete"]);
        return $response;
    }
	
    public static function deleteMany(array $listings) {
        $responses = [];
        foreach ($listings as $slid) {
			if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
				throw new \Exception('SLID failed validation');
			}
            \Shopiro\ShopiroClient::createRequest($endpoint=['set', 'listing'], $payload=["slid" => $slid, "act"=>"delete"], $queue='q', $callback=function($response) use (&$responses, $listing) {
                $responses[$listing['slid']] = $response;
            });
        }
		\Shopiro\ShopiroClient::executeQueue($queue);
        return $responses;
    }
	
}