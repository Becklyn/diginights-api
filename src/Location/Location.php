<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\Location;

use Becklyn\DiginightsApi\SeatingChart\SeatingChart;

class Location
{
    private string $uuid;
    private string $name;
    /** @var SeatingChart[] */
    private array $seatingCharts;

    /**
     * @param \Becklyn\DiginightsApi\SeatingChart\SeatingChart[] $seatingCharts
     */
    public function __construct(string $uuid, string $name, array $seatingCharts = [])
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->seatingCharts = $seatingCharts;
    }

    public function uuid() : string
    {
        return $this->uuid;
    }

    public function name() : string
    {
        return $this->name;
    }

    /**
     * @return \Becklyn\DiginightsApi\SeatingChart\SeatingChart[]
     */
    public function seatingCharts() : array
    {
        return $this->seatingCharts;
    }
}
