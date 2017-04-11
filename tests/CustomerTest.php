<?php
namespace ContactHub\Tests;

use ContactHub\ContactHub;
use ContactHub\Exception;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContactHub */
    private $contactHub;

    public function setUp()
    {
        $token = '68e6b3be8461489cac188c585cc0e694c72817cd72d04736a798ca4d9c5edcee';
        $workspaceId = '37333bf0-73d9-440c-9d66-ac63936af5af';
        $this->contactHub = ContactHub::create($token, $workspaceId);
    }

    public function testGetCustomers()
    {
        $nodeId = 'ead3702f-c755-4a6f-afe5-daea6634b5e5';
        $customers = $this->contactHub->getCustomers($nodeId);

        assertEquals([], $customers['elements']);
        assertEquals(10, $customers['page']['size']);
    }

    public function testCustomersNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('node not foundnot_present_node_id');

        $this->contactHub->getCustomers('not_present_node_id');
    }
}