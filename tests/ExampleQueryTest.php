<?php
namespace ContactHub\Tests;

use ContactHub\QueryBuilder;
use ContactHub\QueryBuilder\CombinedQuery;
use ContactHub\QueryBuilder\Condition\AtomicCondition;
use ContactHub\QueryBuilder\Condition\CompositeCondition;
use ContactHub\QueryBuilder\SimpleQuery;

class ExampleQueryTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $simpleWithAtomicCondition = SimpleQuery::with(AtomicCondition::where('firstName' , 'IS_NOT_NULL'));
        $simpleWithCompositeCondition = SimpleQuery::with(
            CompositeCondition::where(
                'OR',
                AtomicCondition::where('base.lastName', 'IS', 'Giovanni'),
                AtomicCondition::where('base.lastName', 'IS', 'Giacomo')
            )
        );
        $combined = CombinedQuery::with('OR', $simpleWithCompositeCondition, $simpleWithAtomicCondition);
        $query = QueryBuilder::createQuery($combined, 'named_query');

        $expected = [
            'name' => 'named_query',
            'query' => [
                'type' => 'combined',
                'conjunction' => 'OR',
                'queries' => [
                    [
                        'type' => 'simple',
                        'are' => [
                            'type' => 'composite',
                            'conjunction' => 'OR',
                            'conditions' => [
                                [
                                    'type' => 'atomic',
                                    'attribute' => 'base.lastName',
                                    'operator' => 'IS',
                                    'value' => 'Giovanni'
                                ],
                                [
                                    'type' => 'atomic',
                                    'attribute' => 'base.lastName',
                                    'operator' => 'IS',
                                    'value' => 'Giacomo'
                                ],
                            ]
                        ]
                    ],
                    [
                        'type' => 'simple',
                        'are' => [
                            'type' => 'atomic',
                            'attribute' => 'firstName',
                            'operator' => 'IS_NOT_NULL'
                        ]
                    ]
                ]
            ]
        ];

        assertEquals($expected, $query->build());
    }

}