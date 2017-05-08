# ContactHub PHP SDK

[![Build Status](https://travis-ci.org/contactlab/contacthub-sdk-php.svg?branch=master)](https://travis-ci.org/contactlab/contacthub-sdk-php)
[![Latest Stable Version](https://poser.pugx.org/contactlab/contacthub-sdk-php/v/stable)](https://packagist.org/packages/contactlab/contacthub-sdk-php)
[![Total Downloads](https://poser.pugx.org/contactlab/contacthub-sdk-php/downloads)](https://packagist.org/packages/contactlab/contacthub-sdk-php)
[![License](https://poser.pugx.org/contactlab/contacthub-sdk-php/license)](https://packagist.org/packages/contactlab/contacthub-sdk-php)

PHP SDK for the ContactHub API.

## Installation

```sh
composer require contactlab/contacthub-sdk-php
```

## Documentation

Documentation can be found in the the [docs](docs) directory.

## Quick start

### Create customer
```php
use ContactHub\ContactHub;

$contactHub = new ContactHub('TOKEN', 'WORKSPACE_ID', 'NODE_ID');

$customer = [
    'externalId' => 'externalId',
    'base' => [
        'firstName' => 'First Name',
        'lastName' => 'Lastddd Name',
        'contacts' => [
            'email' => 'email@example.com'
        ]
    ],
    'extra' => 'extra string',
    'tags' => [
        'auto' => ['autotag'],
        'manual' => ['manualtag']
    ],
    'enabled' => true
];
$contactHub->addCustomer($customer);
```

### Retrieve Customers
```php
use ContactHub\ContactHub;
use ContactHub\GetCustomersOptions;

$contactHub = new ContactHub('TOKEN', 'WORKSPACE_ID', 'NODE_ID');

$options = GetCustomersOptions::create()
    ->withExternalId('58ede74e05d14')
    ->withFields(['base.firstName']);
$customers = $contactHub->getCustomers($options);
```

### Create Event
```php
use ContactHub\ContactHub;

$contactHub = new ContactHub('TOKEN', 'WORKSPACE_ID', 'NODE_ID');

$event = [
    'type' => EventType::VIEWED_PAGE,
    'context' => EventContext::MOBILE,
    'properties' => [
        'url' => 'http://ecommerce.event.url'
    ],
    'date' => date('c')
];

$contactHub->addEvent('a_customer_id', $event);
```

### Query Builder
```php
use ContactHub\ContactHub;
use ContactHub\GetCustomersOptions;
use ContactHub\QueryBuilder;
use ContactHub\QueryBuilder\CombinedQuery;
use ContactHub\QueryBuilder\Condition\AtomicCondition;
use ContactHub\QueryBuilder\Condition\CompositeCondition;
use ContactHub\QueryBuilder\SimpleQuery;

$simpleWithAtomicCondition = SimpleQuery::with(AtomicCondition::where('firstName' , 'IS_NOT_NULL'));
$simpleWithCompositeCondition = SimpleQuery::with(
    CompositeCondition::where(
        'OR',
        AtomicCondition::where('base.lastName', 'IS', 'Giovanni'),
        AtomicCondition::where('base.lastName', 'IS', 'Giacomo')
    )
);
$combined = CombinedQuery::with('OR', $simpleWithCompositeCondition, $simpleWithAtomicCondition);
$query = QueryBuilder::createQuery($combined, 'named_query');

$contactHub = new ContactHub('TOKEN', 'WORKSPACE_ID', 'NODE_ID');

$options = GetCustomersOptions::create()->withQuery($query->build());
$customers = $contactHub->getCustomers($options);
```
