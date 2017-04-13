<?php
namespace ContactHub\QueryBuilder\Condition;

class CompositeCondition implements Condition
{
    private $conjunction;
    /**
     * @var Condition[]
     */
    private $conditions;

    /**
     * @param string $conjunction
     * @param Condition[] ...$conditions
     * @return static
     */
    public static function where($conjunction, Condition ...$conditions)
    {
        return new static($conjunction, $conditions);
    }

    private function __construct($conjunction, array $conditions)
    {
        $this->conjunction = (string) $conjunction;
        $this->conditions = $conditions;
    }

    public function build()
    {
        return [
            'type' => 'composite',
            'conjunction' => $this->conjunction,
            'conditions' => array_map(function (Condition $condition) {
                return $condition->build();
            }, $this->conditions)
        ];
    }
}