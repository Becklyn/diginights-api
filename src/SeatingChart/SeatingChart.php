<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\SeatingChart;

class SeatingChart
{
    private string $key;
    private string $name;
    /** @var SeatCategory[] */
    private array $categories;
    private ?string $thumbnail;

    /**
     * @param SeatCategory[] $categories
     */
    public function __construct(string $key, string $name, array $categories = [], string $thumbnail = null)
    {
        $this->key = $key;
        $this->name = $name;
        $this->categories = $categories;
        $this->thumbnail = $thumbnail;
    }

    public function key() : string
    {
        return $this->key;
    }

    public function name() : string
    {
        return $this->name;
    }

    /**
     * @return SeatCategory[]
     */
    public function categories() : array
    {
        return $this->categories;
    }

    public function thumbnail() : ?string
    {
        return $this->thumbnail;
    }
}
