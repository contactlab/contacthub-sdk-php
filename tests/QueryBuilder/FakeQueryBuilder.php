<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\QueryBuilder;

class FakeQueryBuilder implements QueryBuilder
{
    public function build()
    {
        return ['fake_query_builder'];
    }
}