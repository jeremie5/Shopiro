<?php
namespace Shopiro;

class Listing {
    
    private $shopiroClient;
    private $listingFactory;

    public function __construct(ShopiroClient $shopiroClient, ListingFactory $listingFactory) {
        $this->shopiroClient = $shopiroClient;
        $this->listingFactory = $listingFactory;
    }
	
    public function create(string $type, array $data) {
		$listingObject = $this->listingFactory->create($type, $data);
		return $listingObject;
    }
	
    public function getAll(int $count, int $offset) {
        $response = $this->shopiroClient->createRequest($endpoint=['get', 'listings'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public function get(string|array $slid){
		if(is_array($slid)){
			return self::getMany($slid);
		}
		return self::getSingle($slid);
	}
	
    public function getSingle(string $slid) {
		if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
			throw new \Exception('SLID failed validation');
		}
        $response = $this->shopiroClient->createRequest($endpoint=['get', 'listing'], $payload=["slid" => $slid]);
		return new BaseListingObject((array)$response);
    }
	
    public function getMany(array $slids) {
        $result = [];
        foreach ($slids as $slid) {
			if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
				throw new \Exception('SLID failed validation');
			}
            $this->shopiroClient->createRequest($endpoint=['get', 'listing'], $payload=["slid" => $slid], $queue='q', $callback=function($response) use (&$result, $slid) {
                $result[$slid] = new BaseListingObject((array)$response);
            });
        }
        return $result;
    }
	
	public function modify(array $listing){
		if(is_array($listing)){
			return self::modifyMany($listing);
		}
		return self::modifySingle($listing);
	}
	
    public function modifySingle(array $listing) {
		if(!is_array($listing)){
			throw new \Exception('Bad listing representation');
		}
        $response = $this->shopiroClient->createRequest($endpoint=['set', 'listing'], $payload=["lis" => $listing, "act"=>"modify"]);
        return $response;
    }
	
    public function modifyMany(array $listings) {
        $responses = [];
        foreach ($listings as $listing) {
			if(!is_array($listing)){
				throw new \Exception('Bad listing representation');
			}
            $this->shopiroClient->createRequest($endpoint=['set', 'listing'], $payload=["lis" => $listing, "act"=>"modify"], $queue='q', $callback=function($response) use (&$responses, $listing) {
                $responses[$listing['slid']] = $response;
            });
        }
		$this->shopiroClient->executeQueue($queue);
        return $responses;
    }
	
	public function delete(string|array $listing){
		if(is_array($listing)){
			return self::deleteMany($listing);
		}
		return self::deleteSingle($listing);
	}
	
    public function deleteSingle(string $listing) {
        $response = $this->shopiroClient->createRequest($endpoint=['set', 'listing'], $payload=["slid" => $listing, "act"=>"delete"]);
        return $response;
    }
	
    public function deleteMany(array $listings) {
        $responses = [];
        foreach ($listings as $slid) {
			if($slid!==strtoupper($slid) || strlen($slid)<12 || strlen($slid)>13){
				throw new \Exception('SLID failed validation');
			}
			$this->shopiroClient->createRequest($endpoint=['set', 'listing'], $payload=["slid" => $slid, "act"=>"delete"], $queue='q', $callback=function($response) use (&$responses, $listing) {
                $responses[$listing['slid']] = $response;
            });
        }
		$this->shopiroClient->executeQueue($queue);
        return $responses;
    }
	
}