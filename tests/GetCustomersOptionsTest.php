<?php
namespace ContactHub\Tests;

use ContactHub\GetCustomersOptions;

class GetCustomersOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GetCustomersOptions
     */
    private $options;

    public function setUp()
    {
        $this->options = new GetCustomersOptions();
    }

    public function testNoParams()
    {
        assertEquals([], $this->options->getParams());
    }

    public function testExternalId()
    {
        $this->options->withExternalId('an_external_id');

        assertEquals(['externalId' => 'an_external_id'], $this->options->getParams());
    }

    public function testFilterFields()
    {
        $this->options->withFields(['base.firstName', 'base.lastName']);

        assertEquals(['fields' => 'base.firstName,base.lastName'], $this->options->getParams());
    }

    public function testQuery()
    {
        $this->options->withQuery(['name' => 'any_name']);

        assertEquals(['query' => '{"name":"any_name"}'], $this->options->getParams());
    }

    public function testSort()
    {
        $this->options->withSortBy('base.firstName', 'desc');
        assertEquals(['sort' => 'base.firstName,desc'], $this->options->getParams());

        $this->options->withSortBy('base.firstName');
        assertEquals(['sort' => 'base.firstName'], $this->options->getParams());
    }

    public function testSortDirectionValidation()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Direction should be: asc, desc');

        $this->options->withSortBy('any_field', 'invalid_direction');
    }

    public function testPage()
    {
        $this->options->withPage(2);

        assertEquals(['page' => 2], $this->options->getParams());
    }
}