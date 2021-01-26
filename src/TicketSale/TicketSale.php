<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\TicketSale;

use Becklyn\DiginightsApi\TicketType\TicketType;

class TicketSale
{
    private string $uuid;
    private bool $isActive;
    private \DateTimeImmutable $salesStart;
    private \DateTimeImmutable $salesEnd;
    private string $url;
    /** @var TicketType[] */
    private array $ticketTypes;
    private ?string $seatingChartKey;

    /**
     * @param TicketType[] $ticketTypes
     */
    public function __construct(
        // these come with both ticket sale details, event details and create event
        string $uuid,
        bool $isActive,
        \DateTimeImmutable $salesStart,
        \DateTimeImmutable $salesEnd,
        string $url,
        // these come only with ticket sale details
        array $ticketTypes = [],
        ?string $seatingChartKey = null
    ) {
        $this->uuid = $uuid;
        $this->isActive = $isActive;
        $this->salesStart = $salesStart;
        $this->salesEnd = $salesEnd;
        $this->url = $url;
        $this->ticketTypes = $ticketTypes;
        $this->seatingChartKey = $seatingChartKey;
    }

    public function uuid() : string
    {
        return $this->uuid;
    }

    public function isActive() : bool
    {
        return $this->isActive;
    }

    public function salesStart() : \DateTimeImmutable
    {
        return $this->salesStart;
    }

    public function salesEnd() : \DateTimeImmutable
    {
        return $this->salesEnd;
    }

    public function url() : string
    {
        return $this->url;
    }

    /**
     * @return TicketType[]
     */
    public function ticketTypes() : array
    {
        return $this->ticketTypes;
    }

    public function seatingChartKey() : ?string
    {
        return $this->seatingChartKey;
    }
}
