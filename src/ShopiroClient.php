<?php
namespace Shopiro;

class ShopiroClient{
	
    private $application_id;
    private $application_private_key;
	
	public $max_network_retries;
	
	private static $requestQueues = [];
	
	private $httpClient;
	
	const MAX_CHAIN_LENGTH=64;
	
	const API_BASE_URL="https://shopiro.ca/api/v1";

    public function __construct(int $application_id, string $application_private_key){
        if (version_compare(PHP_VERSION, '8.0.0', '<')) {
            throw new \Exception("ShopiroClient requires PHP version 8.0 or higher.");
        }
        $this->application_id = $application_id;
        $this->application_private_key = $application_private_key;
		$this->max_network_retries=3;
		$this->httpClient = new HttpClient();
    }
	
    public static function createRequest(array $endpoint, array $payload, string|null|bool $queue=null, callable|null $callback=null){
        if ($queue === null || $queue === false) {
            return $this->executeRequest($endpoint, $payload, $callback);
        }
		else
		{
            self::$requestQueues[$queue][] = function() use ($endpoint, $payload, $callback) {
                return $this->executeRequest($endpoint, $payload, $callback);
            };
        }
    }
	
    private static function processResponse(array $response) {
        if (isset($response['success'])) {
			$response['success']['status']='success';
            return $response['success'];
        } elseif (isset($response['failed'])) {
			$response['failed']['status']='failed';
            return $response['failed'];
        }
        return null;
    }	
	
    public static function executeQueue(string $queueName){
        if(!isset(self::$requestQueues[$queueName])){
            return false;
        }
        $results = [];
        foreach(self::$requestQueues[$queueName] as $requestFunction){
            $results[] = $requestFunction();
        }
        return $results;
    }

	private function executeRequest(array $endpoint, array $payload, callable|null $callback=null){
		if(empty($endpoint)){
			throw new \Exception('Cannot send API request, no endpoint');
		}
		$request=[
			"endpoint"=>$endpoint,
			"payload"=>$payload,
			"callback"=>function($response)use($endpoint, $payload, $callback){
				return self::processResponse($response);
			}
		];
		$this->executeRequests($request);
	}

	private function executeRequests(array $requests){
		if(count($requests)>self::MAX_CHAIN_LENGTH){
			throw new \Exception('Cannot send more than '.self::MAX_CHAIN_LENGTH.' API requests at once');
		}
		foreach($requests as $request){
			$chain[]=[
				"request_type"=>$request["endpoint"]["request_type"],
				"request_scope"=>$request["endpoint"]["request_scope"],
				"request_action"=>$request["endpoint"]["request_action"],
				"post"=>$request["payload"]
			];
		}
        $results = [];
		$url = self::API_BASE_URL.'/'.$this->application_id.'/chained';
		$data = $request['payload'];
		$headers = ['X-Custom-Pvk' => $this->application_private_key];
		$response = $this->httpClient->sendRequest($url, 'POST', $data, $headers, $this->max_network_retries);
		if($response === false){
			throw new \Exception('CURL request failed after ' . $this->max_network_retries . ' attempts');
		}
		if(false === $response){
			throw new \Exception('CURL request failed');
		}
		$decodedResponse = json_decode($response, true);
		if(null === $decodedResponse){
			throw new \Exception('Invalid JSON response');
		}
		if(isset($decodedResponse['failed'])){
			throw new \Exception('API request failed: '.$decodedResponse['failed']);
		}
		$results = [];
		foreach($decodedResponse as $endpoint => $reqDetails){
			if(is_array($reqDetails)){
				foreach($reqDetails as $reqId => $reqData){
					if(isset($reqData['chain_key']) && isset($requests[$reqData['chain_key']])){
						$chainKey = $reqData['chain_key'];
						if(is_callable($callback = $requests[$chainKey]['callback'])){
							$results[] = $callback($reqData);
						}
						else
						{
							$results[] = $reqData;
						}
					}
				}
			}
		}
		return $results;
	}
		
}