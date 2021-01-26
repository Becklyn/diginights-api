<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

class ClientResponse
{
    private int $code;
    private array $content;

    public function __construct(int $code, array $content)
    {
        $this->code = $code;
        $this->content = $content;
    }

    public function isSuccessful() : bool
    {
        return 200 === $this->code;
    }

    public function isBadRequest() : bool
    {
        return 400 === $this->code;
    }

    public function isAuthorizationFailed() : bool
    {
        return 401 === $this->code;
    }

    public function isNotFound() : bool
    {
        return 404 === $this->code;
    }

    public function validationErrors() : array
    {
        if (\array_key_exists('errors', $this->content) && !empty($this->content['errors'])) {
            return $this->content['errors'];
        }

        return [];
    }

    public function error() : string
    {
        if (\array_key_exists('error', $this->content) && !empty($this->content['error'])) {
            return $this->content['error'];
        }

        return '';
    }

    public function data() : array
    {
        if (\array_key_exists('data', $this->content) && !empty($this->content['data'])) {
            return $this->content['data'];
        }

        return [];
    }

    public function content() : array
    {
        return $this->content;
    }
}
