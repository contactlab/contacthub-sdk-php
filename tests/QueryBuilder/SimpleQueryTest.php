<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\SimpleQuery;
use ContactHub\Tests\QueryBuilder\Condition\FakeCondition;

class SimpleQueryTest extends \PHPUnit_Framework_TestCase
{
    public function testWithCondition()
    {
        $query = SimpleQuery::with(new FakeCondition());

        $expected = [
            'type' => 'simple',
            'are' => [ 'condition' => ['fake_condition'] ]
        ];

        assertEquals($expected, $query->build());
    }
}
