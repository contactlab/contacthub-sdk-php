<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\GetEventsOptions;

class EventTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

    const MARIO_ROSSI_CUSTOMER_ID = 'be02ac64-4d66-4756-93fc-a9e4955db639';

    public function testGetEvents()
    {
        $events = $this->contactHub->getEvents(self::MARIO_ROSSI_CUSTOMER_ID);

        assertEquals(10, $events['page']['size']);
    }

    public function testGetEventsWithFilter()
    {
        $options = GetEventsOptions::create()->withContext(EventContext::IOT);
        $events = $this->contactHub->getEvents(self::MARIO_ROSSI_CUSTOMER_ID, $options);
    }
}