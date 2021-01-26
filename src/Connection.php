<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

class Connection
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct(/*string $baseUrl, string $apiKey*/)
    {
        $this->baseUrl = 'https://diginights.com/service.php/api0';
        $this->apiKey = '8D4Be3A34d4560faa05C651ae4A79F189756657D05159E9b71c76414835292B9';
//        $this->apiKey = 'INVALIDKEY';
//        $this->baseUrl = $baseUrl;
//        $this->apiKey = $apiKey;
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
