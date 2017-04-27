<?php
namespace ContactHub;

trait IsValidConstant
{
    public static function isValid($constant)
    {
        $val = new \ReflectionClass(__CLASS__);
        return in_array($constant, array_values($val->getConstants()));
    }
}