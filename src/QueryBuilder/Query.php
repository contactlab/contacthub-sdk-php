<?php
namespace ContactHub\QueryBuilder;

interface Query
{
    /**
     * @return array
     */
    public function build();
}