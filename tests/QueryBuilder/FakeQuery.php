<?php
namespace ContactHub\Tests\QueryBuilder;

use ContactHub\QueryBuilder\Query;

class FakeQuery implements Query
{
    public function build()
    {
        return ['fake_query_builder'];
    }
}