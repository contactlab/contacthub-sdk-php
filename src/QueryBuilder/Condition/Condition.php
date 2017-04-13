<?php
namespace ContactHub\QueryBuilder\Condition;

interface Condition
{
    /**
     * @return array
     */
    public function build();
}