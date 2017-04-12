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
        $this->contactHub = ContactHub::create(Auth::TOKEN, Auth::WORKSPACE_ID);
    }

    public function testGetCustomers()
    {
        $customers = $this->contactHub->getCustomers(Auth::NODE_ID);

        assertCount(4, $customers['elements']);
        assertEquals(10, $customers['page']['size']);
    }

    public function testGetCustomersWithExternalId()
    {
        $customers = $this->contactHub->getCustomers(Auth::NODE_ID, '58ede74e05d14');

        assertCount(1, $customers['elements']);
        assertEquals('Giacomo', $customers['elements'][0]['base']['firstName']);
        assertEquals('Poretti', $customers['elements'][0]['base']['lastName']);
        assertEquals(10, $customers['page']['size']);
    }

    public function testCustomersNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('node not foundnot_present_node_id');

        $this->contactHub->getCustomers('not_present_node_id');
    }

    public function testAddCustomer()
    {
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
        return $this->contactHub->addCustomer(Auth::NODE_ID, $customer);
    }

    /**
     * @depends testAddCustomer
     */
    public function testDeleteCustomer($customer)
    {
        return $this->contactHub->deleteCustomer($customer['id']);
    }
}
