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

    public function testGetCustomersWithExternalId()
    {
        $nodeId = 'ead3702f-c755-4a6f-afe5-daea6634b5e5';
        $customers = $this->contactHub->getCustomers($nodeId, 'externalId');

        assertEquals([], $customers['elements']);
        assertEquals(10, $customers['page']['size']);
    }

    public function testAddAndDeleteCustomer()
    {
        $nodeId = 'ead3702f-c755-4a6f-afe5-daea6634b5e5';
        $customer = [
            'externalId' => 'externalIdAltroaa',
            'base' => [
                'firstName' => 'First Nameaa',
                'lastName' => 'Lastddd Nameaa',
                'contacts' => [
                    'email' => 'email@dddexaaample.com'
                ]
            ],
            'extra' => 'extra string',
            'tags' => [
                'auto' => ['autotag'],
                'manual' => ['manualtag']
            ],
            'enabled' => true
        ];
        $newCustomer = $this->contactHub->addCustomer($nodeId, $customer);

        $this->contactHub->deleteCustomer($newCustomer['id']);
    }

    public function testCustomersNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('node not foundnot_present_node_id');

        $this->contactHub->getCustomers('not_present_node_id');
    }
}
