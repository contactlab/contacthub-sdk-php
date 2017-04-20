<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\EventType;
use ContactHub\GetEventsOptions;

class EventTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

    public function testGetEvents()
    {
        $events = $this->contactHub->getEvents(Customer::MARIO_ROSSI);

        assertEquals(10, $events['page']['size']);
    }

    public function testGetEventsWithFilter()
    {
        $options = GetEventsOptions::create()
            ->withContext(EventContext::ECOMMERCE);
        $events = $this->contactHub->getEvents(Customer::ALDO_BAGLIO, $options);

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

        $event = $this->contactHub->addEvent(Customer::MARIO_ROSSI, $event);

        assertEquals('http://ecommerce.event.url', $event['properties']['url']);
        return $event;
    }

    /**
     * @depends testCreateEvent
     */
    public function testDeleteEvent(array $event)
    {
        $this->contactHub->deleteEvent($event['id']);
    }
}