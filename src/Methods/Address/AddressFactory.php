<?php
namespace Shopiro\Address;

class AddressFactory {

    public static function create(string $type, array $data) {
		return new AddressObject($data);
    }
	
}