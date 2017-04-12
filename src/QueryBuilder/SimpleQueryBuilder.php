<?php
namespace ContactHub\QueryBuilder;

class SimpleQueryBuilder
{
    private $name;
    private $conditions = [];

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function withCondition($attribute, $operator, $value = null)
    {
        $this->conditions[] = [
            'type' => 'atomic',
            'attribute' => $attribute,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function build()
    {
        return [
            'name' => $this->name,
            'query' => [
                'type' => 'simple',
                'are' => $this->conditions[1]
            ],
        ];
    }
}