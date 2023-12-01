<?php
namespace Shopiro;

if (!class_exists(\Composer\Autoload\ClassLoader::class)) {
	require(__DIR__."/ShopiroClient.php");
	require(__DIR__."/HttpClient.php");

	require(__DIR__."/Methods/Listing/Listing.php");
	require(__DIR__."/Methods/Listing/BaseListingObject.php");
	require(__DIR__."/Methods/Listing/ListingFactory.php");
	require(__DIR__."/Methods/Listing/GroceryListingObject.php");
	require(__DIR__."/Methods/Listing/JobListingObject.php");
	require(__DIR__."/Methods/Listing/MarketplaceFoodListingObject.php");
	require(__DIR__."/Methods/Listing/MarketplaceHighVolumeListingObject.php");
	require(__DIR__."/Methods/Listing/MarketplaceLowVolumeListingObject.php");
	require(__DIR__."/Methods/Listing/RealEstateRentalListingObject.php");
	require(__DIR__."/Methods/Listing/RealEstateSaleListingObject.php");
	require(__DIR__."/Methods/Listing/ServiceListingObject.php");
	require(__DIR__."/Methods/Listing/VehicleRentalListingObject.php");
	require(__DIR__."/Methods/Listing/VehicleSaleListingObject.php");
	require(__DIR__."/Methods/Listing/WholesaleListingObject.php");
	require(__DIR__."/Methods/ListingCategory.php");
	require(__DIR__."/Methods/ListingReview.php");
	require(__DIR__."/Methods/ListingSearch.php");
	require(__DIR__."/Methods/ListingPromotion.php");

	require(__DIR__."/Methods/User/PersonalBalance.php");
	require(__DIR__."/Methods/User/Affiliate.php");

	require(__DIR__."/Methods/Address/Address.php");
	require(__DIR__."/Methods/Address/AddressFactory.php");
	require(__DIR__."/Methods/Address/BaseAddressObject.php");
	require(__DIR__."/Methods/Address/AddressObject.php");

	require(__DIR__."/Methods/Store/Agent.php");
	
	require(__DIR__."/Methods/Conversation.php");
	require(__DIR__."/Methods/Dispute.php");
	require(__DIR__."/Methods/ExchangeRate.php");
	require(__DIR__."/Methods/Graphing.php");
	require(__DIR__."/Methods/HelpArticle.php");
	require(__DIR__."/Methods/Order.php");
	require(__DIR__."/Methods/SellerReview.php");
	require(__DIR__."/Methods/SellerReview.php");
	require(__DIR__."/Methods/ShippingMethod.php");
	require(__DIR__."/Methods/Transaction.php");
	require(__DIR__."/Methods/Warehouse.php");
	require(__DIR__."/Methods/Webhook.php");
}