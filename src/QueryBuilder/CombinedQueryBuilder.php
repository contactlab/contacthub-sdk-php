<?php
namespace ContactHub\QueryBuilder;

class CombinedQueryBuilder implements QueryBuilder
{
    /**
     * @var
     */
    private $conjunction;
    /**
     * @var QueryBuilder[]
     */
    private $queryBuilders;

    /**
     * @param string $conjunction
     * @param QueryBuilder[] ...$queryBuilders
     * @return static
     */
    public static function where($conjunction, QueryBuilder ...$queryBuilders)
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
            'queries' => array_map(function (QueryBuilder $queryBuilder) {
                return $queryBuilder->build();
            }, $this->queryBuilders)
        ];
    }
}