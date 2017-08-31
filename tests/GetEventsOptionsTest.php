<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\GetEventsOptions;
use ContactHub\EventMode;
use ContactHub\EventType;

class GetEventsOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyEventFilter()
    {
        $filter = GetEventsOptions::create();

        assertEquals([], $filter->toParams());
    }

    public function testWithType()
    {
        $filter = GetEventsOptions::create()
            ->withType(EventType::ABANDONED_CART);

        assertEquals(['type' => 'abandonedCart'], $filter->toParams());
    }

    public function testWithTypeValidation()
    {
        $this->expectExceptionMessage('EventType: "INVALID_EVENT_TYPE" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        GetEventsOptions::create()->withType('INVALID_EVENT_TYPE');
    }

    public function testWithContext()
    {
        $filter = GetEventsOptions::create()
            ->withContext(EventContext::CONTACT_CENTER);

        assertEquals(['context' => 'CONTACT_CENTER'], $filter->toParams());
    }

    public function testWithContextValidation()
    {
        $this->expectExceptionMessage('EventContext: "INVALID_EVENT_CONTEXT" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        GetEventsOptions::create()->withContext('INVALID_EVENT_CONTEXT');
    }

    public function testWithMode()
    {
        $filter = GetEventsOptions::create()
            ->withMode(EventMode::ACTIVE);

        assertEquals(['mode' => 'ACTIVE'], $filter->toParams());
    }

    public function testWithModeValidation()
    {
        $this->expectExceptionMessage('EventMode: "INVALID_EVENT_MODE" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        GetEventsOptions::create()->withMode('INVALID_EVENT_MODE');
    }

    public function testWithDateFrom()
    {
        $filter = GetEventsOptions::create()
            ->withDateFrom(new \DateTime('1957-02-20', new \DateTimeZone('Europe/London')));

        assertEquals(['dateFrom' => '1957-02-20T00:00:00+00:00'], $filter->toParams());
    }

    public function testWithDateTo()
    {
        $filter = GetEventsOptions::create()
            ->withDateTo(new \DateTime('1958-02-28', new \DateTimeZone('Europe/London')));

        assertEquals(['dateTo' => '1958-02-28T00:00:00+00:00'], $filter->toParams());
    }

    public function testWithPage()
    {
        $filter = GetEventsOptions::create()
            ->withPage(2);

        assertEquals(['page' => 2], $filter->toParams());
    }
}