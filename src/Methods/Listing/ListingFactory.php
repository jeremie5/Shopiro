<?php
namespace Shopiro\Listing;

class ListingFactory {

    public static function create(string $type, array $data) {
        switch ($type) {
            case 'marketplace_low_volume':
                return new MarketplaceLowVolumeListingObject($data);
            case 'marketplace_high_volume':
				return new MarketplaceHighVolumeListingObject($data);
            case 'marketplace_food':
				return new MarketplaceFoodListingObject($data);
            case 'wholesale':
				return new WholesaleListingObject($data);
            case 'job':
				return new JobListingObject($data);
            case 'vehicle_sale':
				return new VehicleSaleListingObject($data);
            case 'vehicle_rental':
				return new VehicleRentalListingObject($data);
            case 'realestate_sale':
				return new RealEstateSaleListingObject($data);
            case 'realestate_rental':
				return new RealEstateRentalListingObject($data);
            case 'realestate_rental':
				return new RealEstateRentalListingObject($data);
            case 'grocery':
				return new GroceryListingObject($data);
            default:
                throw new \Exception("Unknown listing type $type");
        }
    }
	
}