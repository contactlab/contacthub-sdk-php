<?php
namespace ContactHub\QueryBuilder;

use ContactHub\QueryBuilder\Condition\Condition;

class SimpleQuery implements Query
{
    private $condition;

    /**
     * @param Condition $condition
     * @return static
     */
    public static function with(Condition $condition)
    {
        return new static($condition);
    }

    private function __construct(Condition $condition)
    {
        $this->condition = $condition;
    }

    public function build()
    {
        return [
            'type' => 'simple',
            'are' => $this->condition->build()
        ];
    }
}