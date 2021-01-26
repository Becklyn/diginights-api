<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\TicketType;

class TicketType
{
    private string $name;
    private bool $isActive;
    private string $price;

    public function __construct(string $name, bool $isActive, string $price)
    {
        $this->name = $name;
        $this->isActive = $isActive;
        $this->price = $price;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function isActive() : bool
    {
        return $this->isActive;
    }

    public function price() : string
    {
        return $this->price;
    }
}
