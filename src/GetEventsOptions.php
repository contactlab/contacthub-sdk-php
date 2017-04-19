<?php
namespace ContactHub;

class GetEventsOptions
{
    private $eventType;
    private $eventContext;
    private $eventMode;
    private $dateFrom;
    private $dateTo;
    private $page;

    public static function create()
    {
        return new static();
    }

    /**
     * @param string $eventType
     * @return $this
     */
    public function withType($eventType)
    {
        if (EventType::isValid($eventType)) {
            $this->eventType = (string) $eventType;
            return $this;
        }
        throw new \InvalidArgumentException('EventType: "' . $eventType . '" is invalid');
    }

    /**
     * @param string $eventContext
     * @return $this
     */
    public function withContext($eventContext)
    {
        if (EventContext::isValid($eventContext)) {
            $this->eventContext = (string) $eventContext;
            return $this;
        }
        throw new \InvalidArgumentException('EventContext: "' . $eventContext . '" is invalid');
    }

    /**
     * @param string $eventMode
     * @return $this
     */
    public function withMode($eventMode)
    {
        if (EventMode::isValid($eventMode)) {
            $this->eventMode = (string) $eventMode;
            return $this;
        }
        throw new \InvalidArgumentException('EventMode: "' . $eventMode . '" is invalid');
    }

    /**
     * @param \DateTime $dateFrom
     * @return $this
     */
    public function withDateFrom(\DateTime $dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @param \DateTime $dateTo
     * @return $this
     */
    public function withDateTo(\DateTime $dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    public function withPage($page)
    {
        $this->page = (integer) $page;
        return $this;
    }

    /**
     * @return array
     */
    public function toParams()
    {
        return array_filter([
            'type' => $this->eventType,
            'context' => $this->eventContext,
            'mode' => $this->eventMode,
            'dateFrom' => $this->dateFrom ? $this->dateFrom->format('c') : null,
            'dateTo' => $this->dateTo ? $this->dateTo->format('c') : null,
            'page' => $this->page
        ]);
    }
}