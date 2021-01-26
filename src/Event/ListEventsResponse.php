<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

class ListEventsResponse
{
    /** @var Event[] */
    private array $events;
    private int $page;
    private int $totalResults;

    /**
     * @param Event[] $events
     */
    public function __construct(array $events, int $page, int $totalResults)
    {
        $this->events = $events;
        $this->page = $page;
        $this->totalResults = $totalResults;
    }

    /**
     * @return Event[]
     */
    public function events() : array
    {
        return $this->events;
    }

    public function page() : int
    {
        return $this->page;
    }

    public function totalResults() : int
    {
        return $this->totalResults;
    }
}
