<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Event;

use Becklyn\DiginightsApi\TicketSale\CreateTicketSaleRequest;

class CreateEventRequest
{
    private string $name;
    private EventCategory $category;
    private \DateTimeImmutable $dateStart;
    private \DateTimeImmutable $dateEnd;
    private AgeRestriction $ageFrom;
    private int $locationId;
    private CreateTicketSaleRequest $ticketSale;
    private ?string $seatingChartKey;

    public function __construct(
        string $name,
        EventCategory $category,
        \DateTimeImmutable $dateStart,
        \DateTimeImmutable $dateEnd,
        AgeRestriction $ageFrom,
        int $locationId,
        CreateTicketSaleRequest $ticketSale,
        string $seatingChartKey = null
    ) {
        $this->name = $name;
        $this->category = $category;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->ageFrom = $ageFrom;
        $this->locationId = $locationId;
        $this->ticketSale = $ticketSale;
        $this->seatingChartKey = $seatingChartKey;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function category() : EventCategory
    {
        return $this->category;
    }

    public function dateStart() : \DateTimeImmutable
    {
        return $this->dateStart;
    }

    public function dateEnd() : \DateTimeImmutable
    {
        return $this->dateEnd;
    }

    public function ageFrom() : AgeRestriction
    {
        return $this->ageFrom;
    }

    public function locationId() : int
    {
        return $this->locationId;
    }

    public function ticketSale() : CreateTicketSaleRequest
    {
        return $this->ticketSale;
    }

    public function seatingChartKey() : ?string
    {
        return $this->seatingChartKey;
    }
}
