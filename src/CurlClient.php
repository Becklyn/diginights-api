<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

class CurlClient implements Client
{
    public function get(Connection $connection, string $url) : ClientResponse
    {
        $ch = \curl_init();
        \curl_setopt($ch, \CURLOPT_URL, "{$connection->baseUrl()}$url");
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'GET');
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
        \curl_setopt($ch, \CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            "authorization: {$connection->apiKey()}",
        ]);

        $result = \curl_exec($ch);

        return new ClientResponse((int) \curl_getinfo($ch, \CURLINFO_HTTP_CODE), \json_decode($result, true));
    }

    public function post(Connection $connection, string $url, array $data) : ClientResponse
    {
        $ch = \curl_init();
        \curl_setopt($ch, \CURLOPT_URL, "{$connection->baseUrl()}$url");
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
        \curl_setopt($ch, \CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            "authorization: {$connection->apiKey()}",
        ]);
        $body = \http_build_query($data);
        \curl_setopt($ch, \CURLOPT_POST, 1);
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $body);

        $result = \curl_exec($ch);

        return new ClientResponse((int) \curl_getinfo($ch, \CURLINFO_HTTP_CODE), \json_decode($result, true));
    }
}
