<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

interface Client
{
    public function get(Connection $connection, string $url) : ClientResponse;

    public function post(Connection $connection, string $url, array $data) : ClientResponse;
}
