# ContactHub PHP SDK

## Table of Contents

* [ContactHub](#contacthub)
    * [__construct](#__construct)
    * [getCustomers](#getcustomers)
    * [getCustomer](#getcustomer)
    * [addCustomer](#addcustomer)
    * [updateCustomer](#updatecustomer)
    * [deleteCustomer](#deletecustomer)
    * [patchCustomer](#patchcustomer)
    * [addTag](#addtag)
    * [removeTag](#removetag)
    * [addEducation](#addeducation)
    * [updateEducation](#updateeducation)
    * [deleteEducation](#deleteeducation)
    * [addJob](#addjob)
    * [updateJob](#updatejob)
    * [deleteJob](#deletejob)
    * [generateSessionId](#generatesessionid)
    * [getSessions](#getsessions)
    * [getSession](#getsession)
    * [addSession](#addsession)
    * [deleteSession](#deletesession)
    * [addLike](#addlike)
    * [updateLike](#updatelike)
    * [deleteLike](#deletelike)
    * [getEvents](#getevents)
    * [addEvent](#addevent)
    * [deleteEvent](#deleteevent)

## ContactHub

ContactHub contains method for interact with ContactHub Apis



* Full name: \ContactHub\ContactHub


### __construct

ContactHub constructor.

```php
ContactHub::__construct( string $token, string $workspaceId, string $nodeId )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$token` | **string** |  |
| `$workspaceId` | **string** |  |
| `$nodeId` | **string** |  |




---

### getCustomers

Gets list of customers

```php
ContactHub::getCustomers( \ContactHub\GetCustomersOptions $options = null ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$options` | **\ContactHub\GetCustomersOptions** |  |




---

### getCustomer

Gets details of customer

```php
ContactHub::getCustomer( string $customerId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |




---

### addCustomer

Create a new customer

```php
ContactHub::addCustomer( array $customer ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customer` | **array** |  |




---

### updateCustomer

Modify customer

```php
ContactHub::updateCustomer( string $customerId, array $customer ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$customer` | **array** |  |




---

### deleteCustomer

Delete customer

```php
ContactHub::deleteCustomer( string $customerId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |




---

### patchCustomer

Modifies partially the customer

```php
ContactHub::patchCustomer( string $customerId, array $customer ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$customer` | **array** |  |




---

### addTag

Add a new tag to customer

```php
ContactHub::addTag( string $customerId, string $tag ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$tag` | **string** |  |




---

### removeTag

Delete tag from customer

```php
ContactHub::removeTag( string $customerId, string $tag ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$tag` | **string** |  |




---

### addEducation

Create customer education

```php
ContactHub::addEducation( string $customerId, array $education ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$education` | **array** |  |




---

### updateEducation

Modify customer education

```php
ContactHub::updateEducation( string $customerId, string $educationId, array $education ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$educationId` | **string** |  |
| `$education` | **array** |  |




---

### deleteEducation

Delete customer education

```php
ContactHub::deleteEducation( string $customerId, string $educationId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$educationId` | **string** |  |




---

### addJob

Add customer Job

```php
ContactHub::addJob( string $customerId, array $job ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$job` | **array** |  |




---

### updateJob

Update customer Job

```php
ContactHub::updateJob( string $customerId, string $jobId, array $job ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$jobId` | **string** |  |
| `$job` | **array** |  |




---

### deleteJob

Delete customer Job

```php
ContactHub::deleteJob( string $customerId, string $jobId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$jobId` | **string** |  |




---

### generateSessionId

Generate session id

```php
ContactHub::generateSessionId(  ): string
```







---

### getSessions

Gets list of session assign to customer

```php
ContactHub::getSessions( string $customerId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |




---

### getSession

Gets a specific sessions assigned at customer

```php
ContactHub::getSession( string $customerId, string $sessionId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$sessionId` | **string** |  |




---

### addSession

Create a session of customer

```php
ContactHub::addSession( string $customerId, string $sessionId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$sessionId` | **string** |  |




---

### deleteSession

Delete a session of customer

```php
ContactHub::deleteSession( string $customerId, string $sessionId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$sessionId` | **string** |  |




---

### addLike

Create customer like

```php
ContactHub::addLike( string $customerId, array $like ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$like` | **array** |  |




---

### updateLike

Modify customer like

```php
ContactHub::updateLike( string $customerId, string $likeId, array $like ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$likeId` | **string** |  |
| `$like` | **array** |  |




---

### deleteLike

Delete customer like

```php
ContactHub::deleteLike( string $customerId, string $likeId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$likeId` | **string** |  |




---

### getEvents

Get customer events

```php
ContactHub::getEvents( string $customerId, \ContactHub\GetEventsOptions $options = null ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$options` | **\ContactHub\GetEventsOptions** |  |




---

### addEvent

Add customer event

```php
ContactHub::addEvent( string $customerId, array $event ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$customerId` | **string** |  |
| `$event` | **array** |  |




---

### deleteEvent

Delete customer event

```php
ContactHub::deleteEvent( string $eventId ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$eventId` | **string** |  |




---



--------
> This document was automatically generated from source code comments on 2017-04-27 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
