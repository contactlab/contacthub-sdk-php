<?php
namespace ContactHub\Tests;

use ContactHub\QueryBuilder;
use ContactHub\Tests\QueryBuilder\FakeQuery;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testOptionalName()
    {
        $query = QueryBuilder::createQuery(new FakeQuery());

        $expected = [
            'name' => '',
            'query' => ['fake_query_builder']
        ];

        assertEquals($expected, $query->build());
    }

    public function testWithName()
    {
        $query = QueryBuilder::createQuery(new FakeQuery(), 'named_query');

        $expected = [
            'name' => 'named_query',
            'query' => ['fake_query_builder']
        ];

        assertEquals($expected, $query->build());
    }
}