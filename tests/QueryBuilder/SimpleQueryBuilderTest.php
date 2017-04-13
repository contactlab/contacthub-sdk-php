<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\SimpleQueryBuilder;
use ContactHub\Tests\QueryBuilder\Condition\FakeCondition;

class SimpleQueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testWithCondition()
    {
        $query = SimpleQueryBuilder::where(new FakeCondition());

        $expected = [
            'type' => 'simple',
            'are' => ['fake_condition']
        ];

        assertEquals($expected, $query->build());
    }
}
