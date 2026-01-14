<?php


namespace Pixtech\InPost\ShipX\Traits;

trait functions
{
    /**
     * Get request headers.
     *
     * @return array
     */
    protected function requestHeaders(): array{
        return [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];
    }
}
