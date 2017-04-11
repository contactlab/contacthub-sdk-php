<?php

use ContactHub\Exception;
use ContactHub\GuzzleApiClient;

class GuzzleApiClientTest extends PHPUnit_Framework_TestCase
{
    const VALID_TOKEN = '68e6b3be8461489cac88c585cc0e694c72817cd72d04736a798ca4d9c5edcee';
    const WORKSPACE_ID = '37333bf0-73d9-440c-9d66-ac63936af5af';

    public function testAuthorizationError()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The client is not authorized to access the API');

        $client = new GuzzleApiClient('INVALID TOKEN', self::WORKSPACE_ID);
        $client->get('customers');
    }

    public function testNotFoundError()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Not Found');

        $client = new GuzzleApiClient(self::VALID_TOKEN, self::WORKSPACE_ID);
        $client->get('NOT_EXISTENT_ROUTE');
    }
}