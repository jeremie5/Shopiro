<?php
namespace Shopiro;

class HelpArticle {
	
    public static function getAll(int $count, int $offset) {
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'help_articles'], $payload=["ct" => $count, "of"=>$offset]);
		return $response;
    }
	
	public static function get(int $articleId){
        $response = \Shopiro\ShopiroClient::createRequest($endpoint=['get', 'help_article'], $payload=["aid" => $articleId]);
		return $response;
	}

}