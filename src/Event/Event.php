<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use Becklyn\DiginightsApi\Location\Location;
use Becklyn\DiginightsApi\TicketSale\TicketSale;

class Event
{
    private string $uuid;
    private string $name;
    private \DateTimeImmutable $dateStart;
    private \DateTimeImmutable $dateEnd;
    private string $information;
    private string $slug;
    private string $url;
    private ?Location $location;
    private ?TicketSale $ticketSale;

    public function __construct(
        // the following are available both in list and details
        string $uuid,
        string $name,
        \DateTimeImmutable $dateStart,
        \DateTimeImmutable $dateEnd,
        string $information,
        string $slug,
        string $url,
        // the following are only available via details
        ?Location $location = null,
        ?TicketSale $ticketSale = null
    ) {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->information = $information;
        $this->slug = $slug;
        $this->url = $url;
        $this->location = $location;
        $this->ticketSale = $ticketSale;
    }

    public function uuid() : string
    {
        return $this->uuid;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function dateStart() : \DateTimeImmutable
    {
        return $this->dateStart;
    }

    public function dateEnd() : \DateTimeImmutable
    {
        return $this->dateEnd;
    }

    public function information() : string
    {
        return $this->information;
    }

    public function slug() : string
    {
        return $this->slug;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function location() : ?Location
    {
        return $this->location;
    }

    public function ticketSale() : ?TicketSale
    {
        return $this->ticketSale;
    }
}
