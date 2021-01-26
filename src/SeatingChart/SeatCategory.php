<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\SeatingChart;

class SeatCategory
{
    private int $key;
    private string $label;

    public function __construct(int $key, string $label)
    {
        $this->key = $key;
        $this->label = $label;
    }

    public function key() : int
    {
        return $this->key;
    }

    public function label() : string
    {
        return $this->label;
    }
}
