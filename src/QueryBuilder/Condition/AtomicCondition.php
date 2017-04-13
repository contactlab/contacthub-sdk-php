<?php
namespace ContactHub\QueryBuilder\Condition;

class AtomicCondition implements Condition
{
    private $attribute;
    private $operator;
    private $value;

    /**
     * @param string $attribute
     * @param string $operator
     * @param string $value
     * @return AtomicCondition
     */
    public static function where($attribute, $operator, $value = null)
    {
        return new AtomicCondition($attribute, $operator, $value);
    }

    private function __construct($attribute, $operator, $value = null)
    {
        $this->attribute = (string) $attribute;
        $this->operator = (string) $operator;
        $this->value = (string) $value;
    }

    public function build()
    {
        return array_filter([
            'type' => 'atomic',
            'attribute' => $this->attribute,
            'operator' => $this->operator,
            'value' => $this->value
        ]);
    }
}