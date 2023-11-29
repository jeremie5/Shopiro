Shopiro PHP Client Library
===============

##### The Shopiro PHP Client Library is a powerful and easy-to-use PHP client for interacting with the Shopiro API. 
##### This library simplifies the process of making requests to the Shopiro platform, managing responses, and handling errors.

## Requirements

- PHP 8.0 or higher
- cURL extension for PHP

## Installation

You can install the Shopiro PHP Client Library via Composer:

```bash
composer require shopiro/shopiro-client
```

## Usage

Here is a basic usage example of the ShopiroClient, requests can be done in a raw form or using scope specific methods or objects:
```php
<?php
require_once 'vendor/autoload.php';

use Shopiro\ShopiroClient;

// Initialize Shopiro client
$client = new ShopiroClient(123456, 'your_private_key');

// Example: Create a request
$response = $client->createRequest(
    ['request_type' => 'get', 'request_scope' => '', 'request_action' => 'listing']
);

// Handle response
if ($response['status'] === 'success') {
    // Process successful response
} elseif ($response['status'] === 'failed') {
    // Handle failure
}
?>
```

For more detailed listing manipulation, you can use listing objects like MarketplaceLowVolumeListingObject.
```php
<?php
$listing = new Shopiro\Listing::create("marketplace_low_volume");
$listing->setTitle('en', 'Example Product');
$listing->setDescription('en', 'This is a detailed description of the product.');
$listing->setShippingData(['weight' => '1kg', 'x_dimension' => 10, 'y_dimension' => 10]);
$createdListing=$listing->save();
?>
```

## Features
- Easy initialization with application ID and private key
- Support for PHP 8.0 and above
- Automatic handling of network retries
- Request queuing and execution
- Chained API requests with a maximum chain length of 64
- Detailed error handling and exceptions

## API Reference
The Shopiro API documentation can be found at Shopiro API Documentation.

## Contributing
Contributions to the Shopiro PHP Client Library are welcome. Please ensure that your code adheres to the Shopiro PHP Coding Standards.

## License
This library is licensed under the MIT License - see the LICENSE file for details.