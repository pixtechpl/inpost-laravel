<?php

namespace Pixtech\InPost\ShipX\Classes;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Tracking extends Api
{
	/**
	 * Get a tracking details.
	 *
	 * @param string $tracking_number
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function get(string $tracking_number, bool $returnJson = false): array|string
	{
        $route = '/v1/tracking/' . $tracking_number;

        $response = Http::withHeaders($this->requestHeaders())->get($this->apiUrl.$route);

        if($response->status() != 200)
            abort(400, $response->body());

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }
}