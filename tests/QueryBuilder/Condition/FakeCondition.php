<?php
namespace ContactHub\Tests\QueryBuilder\Condition;

use ContactHub\QueryBuilder\Condition\Condition;

class FakeCondition implements Condition
{
    /**
     * @return array
     */
    public function build()
    {
        return ['fake_condition'];
    }
}