<?php
namespace ContactHub\QueryBuilder;

use ContactHub\QueryBuilder\Condition\Condition;

class SimpleQueryBuilder
{
    private $condition;

    private function __construct(Condition $condition)
    {
        $this->condition = $condition;
    }

    public static function where(Condition $condition)
    {
        return new static($condition);
    }

    public function build()
    {
        return [
            'type' => 'simple',
            'are' => $this->condition->build()
        ];
    }
}