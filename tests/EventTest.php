<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\EventType;
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
        $options = GetEventsOptions::create()
            ->withContext(EventContext::ECOMMERCE);
        $events = $this->contactHub->getEvents(self::MARIO_ROSSI_CUSTOMER_ID, $options);

        assertCount(1, $events['elements']);
        assertEquals(EventContext::ECOMMERCE, $events['elements'][0]['context']);
        assertEquals('http://ecommerce.event.url', $events['elements'][0]['properties']['url']);
    }

    public function testCreateEvent()
    {
        self::markTestSkipped('WIP: addEvent not returns event data');
        $event = [
            'type' => EventType::VIEWED_PAGE,
            'context' => EventContext::MOBILE,
            'properties' => [
                'url' => 'http://ecommerce.event.url'
            ],
            'date' => date('c')
        ];
        $this->contactHub->addEvent(self::MARIO_ROSSI_CUSTOMER_ID, $event);
    }
}