# Shopiro PHP Client Library

## The Shopiro PHP Client Library is a powerful and easy-to-use PHP client for interacting with the Shopiro API. This comprehensive tool is designed to facilitate seamless integration with Shopiro, making it a go-to solution for developers looking to leverage the capabilities of Shopiro in their applications.

#### This library simplifies the process of making requests to the Shopiro platform, managing responses, and handling errors. It provides an intuitive interface for developers, allowing them to focus on building features without worrying about the underlying complexities of network communication. By abstracting the details of HTTP requests and responses, the Shopiro Client Library enables faster and more reliable development workflows.

Beyond basic request handling, the library offers advanced features like automatic network retries, request queuing, and the execution of chained API requests, ensuring robust and efficient interactions with the Shopiro API. Its design emphasizes ease of use and flexibility, accommodating a wide range of use cases from simple queries to complex transaction handling.
The inclusion of specialized classes, such as the Listing class and various listing object types, further enriches the library's utility, providing tailored solutions for specific aspects of the Shopiro ecosystem. These classes streamline tasks such as listing creation, modification, and retrieval, offering a structured and scalable approach to managing data.
With comprehensive documentation, clear usage examples, and adherence to modern coding standards, the Shopiro PHP Client Library is an indispensable tool for developers looking to harness the full potential of Shopiro.


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
$client = new ShopiroClient('your_application_id', 'your_private_key');

// Example: Create a request
$response = $client->createRequest(
    ['request_type' => 'get', 'request_scope' => '', 'request_action' => 'listing'],
    ['slid'=>'SLID12345678901']
);

// Handle response
if ($response['status'] === 'success') {
    // Process successful response
} elseif ($response['status'] === 'failed') {
    // Handle failure
}
?>
```

Using the Listing Class
```php
<?php
use Shopiro\Listing;

// Create a listing
$response = Listing::create('marketplace_low_volume', $listing);

// Retrieve multiple listings
$allListings = Listing::getAll(10, 0);

// Retrieve a single listing
$singleListing = Listing::get('SLID12345678901');

// Modify a listing
$modifiedListing = Listing::modify(['slid' => 'SLID12345678901', 'new_data' => 'value']);

// Delete a listing
$deletedListing = Listing::delete('SLID12345678901');
?>
```

For more detailed listing manipulation, you can use listing objects as such:
```php
<?php
use Shopiro\Listing;
// We can create() a new empty listing
$listing = new Listing::create("marketplace_low_volume");

// Or we can retrieve an existing listing as an object
$listing=Listing::get('SLID12345678901');

$listing->setTitle('en-CA', 'Example Product');
$listing->setDescription('en-CA', 'This is a detailed description of the product.');
$listing->setShippingData(['weight' => 2, 'x_dimension' => 10, 'y_dimension' => 10]);

// Save the changes to the existing listing or Shopiro will create a new one if it did not exist
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
- Comprehensive listing management through the Listing class and listing objects

## API Reference
The Shopiro API documentation can be found at Shopiro API Documentation.

## Contributing
Contributions to the Shopiro PHP Client Library are welcome. Please ensure that your code adheres to our existing coding standards.

## License
This library is licensed under the MIT License - see the LICENSE file for details.
