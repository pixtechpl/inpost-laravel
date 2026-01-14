<?php

namespace Pixtech\InPost\ShipX\Classes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Services extends Api
{
    /**
     * Get a list of the available services.
     *
     * @param bool $returnJson
     * @return string|array
     */
    public function list(bool $returnJson = false): array|string
	{
        $cacheName = 'inpost_services_' . $returnJson;

        return Cache::remember($cacheName, config('inpost.cache_time'), function () use ($returnJson) {
            $route = '/v1/services';

            $data = [];

            $response = Http::withHeaders($this->requestHeaders())->get($this->apiUrl.$route, $data);

            if($response->status() != 200)
                abort(400, $response->body());

            return $returnJson ? $response->body() : json_decode($response->body(), true);
        });
    }
}