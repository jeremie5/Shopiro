<?php
namespace Shopiro;

class BaseListingObject {
	
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function save() {
		return \Shopiro\Listing::modifySingle($this->data);
    }
	
    public function delete() {
		return \Shopiro\Listing::deleteSingle($this->data['slid']);
    }
	
}