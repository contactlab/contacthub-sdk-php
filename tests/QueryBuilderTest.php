<?php
namespace ContactHub\Tests;

use ContactHub\QueryBuilder;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testSimpleQueryWithAtomicCondition()
    {
        static::markTestSkipped('WIP');

        $query = QueryBuilder::simple()
            ->withCondition('base.contacts.email', 'IN', '@example.com')
            ->build();

        $expected = [
            'name' => '',
            'query' => [
                'type' => 'simple',
                'are' => [
                    'type' => 'atomic',
                    'attribute' => 'base.contacts.email',
                    'operator' => 'IN',
                    'value' => '@example.com'
                ]
            ]
        ];
        assertEquals($expected, $query);
    }
    public function testSimpleQueryBuilder()
    {
        static::markTestSkipped('WIP');

        $nameQuery = QueryBuilder::simple()
            ->withCondition('base.firstName', 'IS_NOT_NULL')
            ->withCondition('base.lastName', 'EQUALS', 'Rossi')
            ->withConjunction('or')
            ->build();

        $emailQuery = QueryBuilder::simple()
            ->withCondition('base.contacts.email', 'IN', '@example.com')
            ->build();

        $query = QueryBuilder::combined()
            ->withQuery($nameQuery)
            ->withQuery($emailQuery)
            ->withConjunction('INTERSECT')
            ->build();

        dump($query);
    }

}