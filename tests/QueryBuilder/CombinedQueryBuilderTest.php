<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\CombinedQuery;

class CombinedQueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOneQuery()
    {
        $query = CombinedQuery::with('OR', new FakeQuery());

        $expected = [
            'type' => 'combined',
            'conjunction' => 'OR',
            'queries' => [
                ['fake_query_builder']
            ]
        ];

        assertEquals($expected, $query->build());
    }

    public function testWithTwoQuery()
    {
        $query = CombinedQuery::with(
            'OR',
            new FakeQuery(),
            new FakeQuery()
        );

        $expected = [
            'type' => 'combined',
            'conjunction' => 'OR',
            'queries' => [
                ['fake_query_builder'],
                ['fake_query_builder']
            ]
        ];

        assertEquals($expected, $query->build());
    }
}