<?php
namespace ContactHub;

use ContactHub\QueryBuilder\Query;

class QueryBuilder
{
    private $name;
    private $query;

    public static function createQuery(Query $query, $name = '')
    {
        return new static($query, $name);
    }

    private function __construct(Query $query, $name)
    {
        $this->query = $query;
        $this->name = (string) $name;
    }

    /**
     * @return array
     */
    public function build()
    {
        return [
            'name' => $this->name,
            'query' => $this->query->build()
        ];
    }
}