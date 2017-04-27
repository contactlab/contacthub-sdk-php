<?php
namespace ContactHub\Tests;

use ContactHub\EventContext;
use ContactHub\EventType;
use ContactHub\Exception;
use ContactHub\GetEventsOptions;

class EventTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

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
        $event = [
            'type' => EventType::VIEWED_PAGE,
            'context' => EventContext::MOBILE,
            'properties' => [
                'url' => 'http://ecommerce.event.url'
            ],
            'date' => date('c')
        ];

        $this->contactHub->addEvent(Customer::MARIO_ROSSI, $event);
    }

    /**
     * @depends testCreateEvent
     */
    public function testGetEvents()
    {
        $events = $this->contactHub->getEvents(Customer::MARIO_ROSSI);

        assertEquals(10, $events['page']['size']);
        return $events['elements'];
    }

    /**
     * @depends testGetEvents
     */
    public function testDeleteEvent(array $events)
    {
        array_walk($events, function ($event) {
            try {
                $this->contactHub->deleteEvent($event['id']);
            } catch (Exception $e) { }
        });
    }
}