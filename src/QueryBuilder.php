<?php
namespace ContactHub;

use ContactHub\QueryBuilder\CombinedQueryBuilder;
use ContactHub\QueryBuilder\SimpleQueryBuilder;

class QueryBuilder
{
    public static function simple($name = '')
    {
        return new SimpleQueryBuilder($name);
    }

    public static function combined($name = '')
    {
        return new CombinedQueryBuilder($name);
    }
}