<?php
namespace ContactHub\Tests;

use ContactHub\GetCustomersOptions;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

    public function testGetCustomer()
    {
        $customer = $this->contactHub->getCustomer('be02ac64-4d66-4756-93fc-a9e4955db639');

        assertEquals('Aldo', $customer['base']['firstName']);
        assertEquals('Baglio', $customer['base']['lastName']);
    }

    public function testGetCustomers()
    {
        $customers = $this->contactHub->getCustomers();

        assertCount(4, $customers['elements']);
        assertEquals(10, $customers['page']['size']);
    }

    public function testGetCustomersWithExternalId()
    {
        $options = GetCustomersOptions::create()
            ->withExternalId('58ede74e05d14');
        $customers = $this->contactHub->getCustomers($options);

        assertCount(1, $customers['elements']);
        assertEquals('Giacomo', $customers['elements'][0]['base']['firstName']);
        assertEquals('Poretti', $customers['elements'][0]['base']['lastName']);
    }

    public function testGetCustomersWithFilteredFields()
    {
        $options = GetCustomersOptions::create()
            ->withExternalId('58ede74e05d14')
            ->withFields(['base.firstName']);
        $customers = $this->contactHub->getCustomers($options);

        assertCount(1, $customers['elements']);
        assertEquals('Giacomo', $customers['elements'][0]['base']['firstName']);
        assertNull($customers['elements'][0]['base']['lastName']);
    }

    public function testGetCustomerSortedByFirstName()
    {
        $options = GetCustomersOptions::create()
            ->withSortBy('base.firstName', 'asc');
        $customers = $this->contactHub->getCustomers($options);

        assertCount(4, $customers['elements']);
        assertEquals('Aldo', $customers['elements'][0]['base']['firstName']);
        assertEquals('Giacomo', $customers['elements'][1]['base']['firstName']);
        assertEquals('Giovanni', $customers['elements'][2]['base']['firstName']);
        assertEquals('Mario', $customers['elements'][3]['base']['firstName']);
    }

    public function testCustomerNotFound()
    {
        $options = GetCustomersOptions::create()->withExternalId('not_existent_external_id');
        $customers = $this->contactHub->getCustomers($options);

        assertCount(0, $customers['elements']);
    }

    public function testUpdateCustomer()
    {
        $newEmail= uniqid() . '@domain.com';
        $customer = [
            'externalId' => '58ede6fa301b2',
            'base' => [
                'firstName' => 'Mario',
                'lastName' => 'Rossi',
                'contacts' => [
                    'email' => $newEmail
                ]
            ]
        ];

        $customer = $this->contactHub->updateCustomer('4b72651c-0dc3-4936-a177-87539d3bd041', $customer);

        assertEquals($newEmail, $customer['base']['contacts']['email']);
    }

    public function testPatchCustomer()
    {
        $newEmail= uniqid() . '@domain.it';
        $customer = [
            'base' => [
                'contacts' => [
                    'email' => $newEmail
                ]
            ]
        ];

        $customer = $this->contactHub->patchCustomer('4b72651c-0dc3-4936-a177-87539d3bd041', $customer);

        assertEquals($newEmail, $customer['base']['contacts']['email']);
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
        return $this->contactHub->addCustomer($customer);
    }

    /**
     * @depends testAddCustomer
     */
    public function testDeleteCustomer($customer)
    {
        return $this->contactHub->deleteCustomer($customer['id']);
    }
}
