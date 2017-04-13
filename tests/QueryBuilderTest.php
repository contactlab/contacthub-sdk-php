<?php
namespace ContactHub\Tests;

use ContactHub\QueryBuilder;
use ContactHub\Tests\QueryBuilder\Condition\FakeCondition;
use ContactHub\Tests\QueryBuilder\FakeQueryBuilder;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleQuery()
    {
        $query = QueryBuilder::simple(new FakeCondition())
            ->withName('simple_query')
            ->build();

        $expected = [
            'name' => 'simple_query',
            'query' => [
                'type' => 'simple',
                'are' => ['fake_condition']
            ]
        ];

        assertEquals($expected, $query);
    }

    public function testCombinedQuery()
    {
        $query = QueryBuilder::combined('OR', new FakeQueryBuilder())
            ->withName('combined_query_builder')
            ->build();

        $expected = [
            'name' => 'combined_query_builder',
            'query' => [
                'type' => 'combined',
                'conjunction' => 'OR',
                'queries' => [
                    ['fake_query_builder']
                ]
            ]
        ];

        assertEquals($expected, $query);
    }
}