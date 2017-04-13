<?php
namespace ContactHub\QueryBuilder;

class CombinedQuery implements Query
{
    /**
     * @var
     */
    private $conjunction;
    /**
     * @var Query[]
     */
    private $queryBuilders;

    /**
     * @param string $conjunction
     * @param Query[] ...$queryBuilders
     * @return static
     */
    public static function with($conjunction, Query ...$queryBuilders)
    {
        return new static($conjunction, $queryBuilders);
    }

    private function __construct($conjunction, array $queryBuilders)
    {
        $this->conjunction = (string) $conjunction;
        $this->queryBuilders = $queryBuilders;
    }

    public function build()
    {
        return [
            'type' => 'combined',
            'conjunction' => $this->conjunction,
            'queries' => array_map(function (Query $queryBuilder) {
                return $queryBuilder->build();
            }, $this->queryBuilders)
        ];
    }
}