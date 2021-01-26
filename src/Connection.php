<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

class Connection
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct(string $baseUrl, string $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function baseUrl() : string
    {
        return $this->baseUrl;
    }

    public function apiKey() : string
    {
        return $this->apiKey;
    }
}
