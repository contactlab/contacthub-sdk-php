<?php
namespace ContactHub\Tests;

use ContactHub\IsValidConstant;

class IsValidConstantTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateOnlyPresentConstant()
    {
        assertTrue(TestClass::isValid(TestClass::TEST_ONE));
        assertTrue(TestClass::isValid(TestClass::TEST_TWO));
        assertFalse(TestClass::isValid('NOT_VALID'));
    }
}

class TestClass
{
    use IsValidConstant;

    const TEST_ONE = 'TEST_ONE';
    const TEST_TWO = 'TEST_TWO';
}