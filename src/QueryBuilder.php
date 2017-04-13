<?php
namespace ContactHub;

use ContactHub\QueryBuilder\CombinedQueryBuilder;
use ContactHub\QueryBuilder\Condition\Condition;
use ContactHub\QueryBuilder\QueryBuilder as BaseQueryBuilder;
use ContactHub\QueryBuilder\SimpleQueryBuilder;

class QueryBuilder implements BaseQueryBuilder
{
    private $name = '';
    /**
     * @var BaseQueryBuilder
     */
    private $queryBuilder;

    /**
     * @param Condition $condition
     * @return static
     */
    public static function simple(Condition $condition)
    {
        return new static(SimpleQueryBuilder::where($condition));
    }

    /**
     * @param $conjunction
     * @param BaseQueryBuilder[] ...$queryBuilders
     * @return static
     */
    public static function combined($conjunction, BaseQueryBuilder ...$queryBuilders)
    {
        return new static(CombinedQueryBuilder::where($conjunction, ...$queryBuilders));
    }

    private function __construct(BaseQueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function withName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @return array
     */
    public function build()
    {
        return [
            'name' => $this->name,
            'query' => $this->queryBuilder->build()
        ];
    }
}