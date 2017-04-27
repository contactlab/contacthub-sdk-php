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

### Documentation

Documentation can be found in the the [docs](docs) directory.

### Query Builder
```php
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
```
