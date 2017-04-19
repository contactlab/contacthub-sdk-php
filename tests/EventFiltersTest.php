<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\EventFilter;
use ContactHub\EventMode;
use ContactHub\EventType;

class EventFiltersTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyEventFilter()
    {
        $filter = EventFilter::create();

        assertEquals([], $filter->toParams());
    }

    public function testWithType()
    {
        $filter = EventFilter::create()
            ->withType(EventType::ABANDONED_CART);

        assertEquals(['type' => 'abandonedCart'], $filter->toParams());
    }

    public function testWithTypeValidation()
    {
        $this->expectExceptionMessage('EventType: "INVALID_EVENT_TYPE" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        EventFilter::create()->withType('INVALID_EVENT_TYPE');
    }

    public function testWithContext()
    {
        $filter = EventFilter::create()
            ->withContext(EventContext::CONTACT_CENTER);

        assertEquals(['context' => 'CONTACT_CENTER'], $filter->toParams());
    }

    public function testWithContextValidation()
    {
        $this->expectExceptionMessage('EventContext: "INVALID_EVENT_CONTEXT" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        EventFilter::create()->withContext('INVALID_EVENT_CONTEXT');
    }

    public function testWithMode()
    {
        $filter = EventFilter::create()
            ->withMode(EventMode::ACTIVE);

        assertEquals(['mode' => 'ACTIVE'], $filter->toParams());
    }

    public function testWithModeValidation()
    {
        $this->expectExceptionMessage('EventMode: "INVALID_EVENT_MODE" is invalid');
        $this->expectException(\InvalidArgumentException::class);

        EventFilter::create()->withMode('INVALID_EVENT_MODE');
    }

    public function testWithDateFrom()
    {
        $filter = EventFilter::create()
            ->withDateFrom(new \DateTime('1957-02-20'));

        assertEquals(['dateFrom' => '1957-02-20T00:00:00+00:00'], $filter->toParams());
    }

    public function testWithDateTo()
    {
        $filter = EventFilter::create()
            ->withDateTo(new \DateTime('1958-09-28'));

        assertEquals(['dateTo' => '1958-09-28T00:00:00+00:00'], $filter->toParams());
    }

    public function testWithPage()
    {
        $filter = EventFilter::create()
            ->withPage(2);

        assertEquals(['page' => 2], $filter->toParams());
    }
}