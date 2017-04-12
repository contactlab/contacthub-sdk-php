# ContactHub PHP SDK

PHP SDK for the ContactHub API.

## Installation

```sh
composer require contactlab/contacthub
```

## Quick start

```php
use ContactHub\ContactHub;
use ContactHub\GetCustomersOptions;

$contactHub = new ContactHub('TOKEN', 'WORKSPACE_ID', 'NODE_ID');

$options = GetCustomersOptions::create()
    ->withExternalId('58ede74e05d14')
    ->withFields(['base.firstName']);
$customers = $contactHub->getCustomers($options);
```
