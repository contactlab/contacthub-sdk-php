<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\CombinedQueryBuilder;

class CombinedQueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testWithOneQuery()
    {
        $query = CombinedQueryBuilder::where('OR', new FakeQueryBuilder());

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
        $query = CombinedQueryBuilder::where(
            'OR',
            new FakeQueryBuilder(),
            new FakeQueryBuilder()
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