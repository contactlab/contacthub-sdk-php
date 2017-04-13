<?php
namespace QueryBuilder\Tests\QueryBuilder\Condition;

use ContactHub\QueryBuilder\Condition\AtomicCondition;

class AtomicConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testWithoutValue()
    {
        $condition = AtomicCondition::where('base.firstName', 'IS_NOT_NULL');

        $expected = [
            'type' => 'atomic',
            'attribute' => 'base.firstName',
            'operator' => 'IS_NOT_NULL'
        ];

        assertEquals($expected, $condition->build());
    }

    public function testWithValue()
    {
        $condition = AtomicCondition::where('base.firstName', 'EQUALS', 'Aldo');

        $expected = [
            'type' => 'atomic',
            'attribute' => 'base.firstName',
            'operator' => 'EQUALS',
            'value' => 'Aldo'
        ];

        assertEquals($expected, $condition->build());
    }
}