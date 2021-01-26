<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\TicketType;

use Becklyn\DiginightsApi\InvalidRequestException;

class AddTicketTypeRequest
{
    private string $ticketSaleUuid;
    private string $name;
    private string $price;
    private bool $isActive;
    /** @var int[] */
    private array $seatCategories;
    private bool $differentSalesPeriod;
    private ?\DateTimeImmutable $salesStart;
    private ?\DateTimeImmutable $salesEnd;

    /**
     * @param int[] $seatCategories
     */
    public function __construct(
        string $ticketSaleUuid,
        string $name,
        string $price,
        bool $isActive,
        array $seatCategories,
        bool $differentSalesPeriod = false,
        ?\DateTimeImmutable $salesStart = null,
        ?\DateTimeImmutable $salesEnd = null
    ) {
        if ($differentSalesPeriod) {
            if (null === $salesStart || null === $salesEnd) {
                throw new InvalidRequestException('If ticket type has different sales period, both start and end of sales must be specified');
            }
        }

        $this->ticketSaleUuid = $ticketSaleUuid;
        $this->name = $name;
        $this->price = $price;
        $this->isActive = $isActive;
        $this->seatCategories = $seatCategories;
        $this->differentSalesPeriod = $differentSalesPeriod;
        $this->salesStart = $salesStart;
        $this->salesEnd = $salesEnd;
    }

    public function ticketSaleUuid() : string
    {
        return $this->ticketSaleUuid;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function price() : string
    {
        return $this->price;
    }

    public function isActive() : bool
    {
        return $this->isActive;
    }

    /**
     * @return int[]
     */
    public function seatCategories() : array
    {
        return $this->seatCategories;
    }

    public function differentSalesPeriod() : bool
    {
        return $this->differentSalesPeriod;
    }

    public function salesStart() : ?\DateTimeImmutable
    {
        return $this->salesStart;
    }

    public function salesEnd() : ?\DateTimeImmutable
    {
        return $this->salesEnd;
    }
}
