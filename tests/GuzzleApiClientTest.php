<?php
namespace ContactHub\Tests;

use ContactHub\Exception;
use ContactHub\GuzzleApiClient;

class GuzzleApiClientTest extends \PHPUnit_Framework_TestCase
{
    public function testAuthorizationError()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The client is not authorized to access the API');

        $client = new GuzzleApiClient('INVALID TOKEN', Auth::WORKSPACE_ID);
        $client->get('customers');
    }

    public function testNotFoundError()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Not Found');

        $client = new GuzzleApiClient(Auth::TOKEN, Auth::WORKSPACE_ID);
        $client->get('NOT_EXISTENT_ROUTE');
    }

    public function testServerError()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Internal Server Error');

        $client = new GuzzleApiClient(Auth::TOKEN, Auth::WORKSPACE_ID);
        $client->delete('customers');
    }
}