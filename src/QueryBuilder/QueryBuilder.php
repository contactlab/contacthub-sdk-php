<?php
namespace ContactHub\QueryBuilder;

interface QueryBuilder
{
    /**
     * @return array
     */
    public function build();
}