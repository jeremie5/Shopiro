<?php
namespace Shopiro;

require(__DIR__."/ShopiroClient.php");
require(__DIR__."/HttpClient.php");

require(__DIR__."/Listing/Listing.php");
require(__DIR__."/Listing/BaseListingObject.php");
require(__DIR__."/Listing/ListingFactory.php");
require(__DIR__."/Listing/GroceryListingObject.php");
require(__DIR__."/Listing/JobListingObject.php");
require(__DIR__."/Listing/MarketplaceFoodListingObject.php");
require(__DIR__."/Listing/MarketplaceHighVolumeListingObject.php");
require(__DIR__."/Listing/MarketplaceLowVolumeListingObject.php");
require(__DIR__."/Listing/RealEstateRentalListingObject.php");
require(__DIR__."/Listing/RealEstateSaleListingObject.php");
require(__DIR__."/Listing/ServiceListingObject.php");
require(__DIR__."/Listing/VehicleRentalListingObject.php");
require(__DIR__."/Listing/VehicleSaleListingObject.php");
require(__DIR__."/Listing/WholesaleListingObject.php");
require(__DIR__."/ListingCategory.php");
require(__DIR__."/ListingReview.php");
require(__DIR__."/ListingSearch.php");
require(__DIR__."/ListingPromotion.php");

require(__DIR__."/User/PersonalBalance.php");
require(__DIR__."/User/Affiliate.php");

require(__DIR__."/Address/Address.php");
require(__DIR__."/Address/Factory.php");
require(__DIR__."/Address/Object.php");
require(__DIR__."/Address/BaseAddressObject.php");

require(__DIR__."/Agent.php");
require(__DIR__."/Conversation.php");
require(__DIR__."/Dispute.php");
require(__DIR__."/ExchangeRate.php");
require(__DIR__."/Graphing.php");
require(__DIR__."/HelpArticle.php");
require(__DIR__."/Order.php");
require(__DIR__."/SellerReview.php");
require(__DIR__."/SellerReview.php");
require(__DIR__."/ShippingMethod.php");
require(__DIR__."/Transaction.php");
require(__DIR__."/Warehouse.php");
require(__DIR__."/Webhook.php");